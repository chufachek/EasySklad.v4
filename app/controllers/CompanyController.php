<?php
class CompanyController
{
    public function setContext()
    {
        verify_csrf();
        if (isset($_POST['company_id'])) {
            $_SESSION['current_company_id'] = $_POST['company_id'] !== '' ? (int) $_POST['company_id'] : null;
        }
        if (isset($_POST['warehouse_id'])) {
            $_SESSION['current_warehouse_id'] = $_POST['warehouse_id'] !== '' ? (int) $_POST['warehouse_id'] : null;
        }
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/app';
        redirect($redirect);
    }

    public function createCompany()
    {
        verify_csrf();
        $name = trim($_POST['name'] ?? '');
        $inn = trim($_POST['inn'] ?? '');
        $address = trim($_POST['address'] ?? '');
        if ($name === '') {
            $_SESSION['flash_error'] = 'Введите название компании.';
            redirect('/app');
        }
        $userId = $_SESSION['user_id'];
        $stmt = db()->prepare('INSERT INTO companies (name, inn, address, owner_user_id, created_at) VALUES (?, ?, ?, ?, NOW())');
        $stmt->execute([$name, $inn, $address, $userId]);
        $companyId = db()->lastInsertId();
        $_SESSION['current_company_id'] = (int) $companyId;
        $_SESSION['flash_success'] = 'Компания создана.';
        redirect('/app');
    }

    public function users()
    {
        view('layouts/app', [
            'page' => 'pages/company_users',
            'pageTitle' => 'Команда',
        ]);
    }

    public function sendInvite()
    {
        verify_csrf();
        $companyId = $_SESSION['current_company_id'] ?? null;
        if (!$companyId) {
            $_SESSION['flash_error'] = 'Сначала выберите компанию.';
            redirect('/c/users');
        }
        $email = trim($_POST['email'] ?? '');
        $role = trim($_POST['role'] ?? 'viewer');
        if ($email === '') {
            $_SESSION['flash_error'] = 'Введите email.';
            redirect('/c/users');
        }
        $stmt = db()->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $invitee = $stmt->fetch();

        $stmt = db()->prepare('INSERT INTO invitations (company_id, inviter_user_id, invitee_email, role, status, created_at) VALUES (?, ?, ?, ?, "pending", NOW())');
        $stmt->execute([$companyId, $_SESSION['user_id'], $email, $role]);
        $inviteId = db()->lastInsertId();

        if ($invitee) {
            $stmt = db()->prepare('INSERT INTO notifications (user_id, type, title, body, is_read, created_at, meta_json) VALUES (?, "invite", "Приглашение в компанию", "Вас пригласили в компанию", 0, NOW(), ?)');
            $meta = json_encode(['invite_id' => $inviteId]);
            $stmt->execute([$invitee['id'], $meta]);
        }

        $_SESSION['flash_success'] = 'Приглашение отправлено.';
        redirect('/c/users');
    }

    public function acceptInvite($id)
    {
        verify_csrf();
        $userId = $_SESSION['user_id'];
        $stmt = db()->prepare('SELECT * FROM invitations WHERE id = ? AND status = "pending"');
        $stmt->execute([$id]);
        $invite = $stmt->fetch();
        if (!$invite) {
            $_SESSION['flash_error'] = 'Приглашение не найдено.';
            redirect('/app/notifications');
        }

        $stmt = db()->prepare('INSERT INTO company_users (company_id, user_id, role, created_at) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$invite['company_id'], $userId, $invite['role']]);

        $stmt = db()->prepare('UPDATE invitations SET status = "accepted" WHERE id = ?');
        $stmt->execute([$id]);

        $stmt = db()->prepare('INSERT INTO notifications (user_id, type, title, body, is_read, created_at, meta_json) VALUES (?, "info", "Вы присоединились к компании", "Приглашение принято", 0, NOW(), NULL)');
        $stmt->execute([$userId]);

        $_SESSION['flash_success'] = 'Вы присоединились к компании.';
        redirect('/app/notifications');
    }

    public function declineInvite($id)
    {
        verify_csrf();
        $stmt = db()->prepare('UPDATE invitations SET status = "declined" WHERE id = ?');
        $stmt->execute([$id]);
        $_SESSION['flash_success'] = 'Приглашение отклонено.';
        redirect('/app/notifications');
    }
}
