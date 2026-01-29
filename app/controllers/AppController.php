<?php
class AppController
{
    private function currentUser()
    {
        $stmt = db()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    }

    private function companyContext()
    {
        $companyId = $_SESSION['current_company_id'] ?? null;
        $warehouseId = $_SESSION['current_warehouse_id'] ?? null;
        return [$companyId, $warehouseId];
    }

    private function sharedData()
    {
        $user = $this->currentUser();
        $pdo = db();
        $companyId = $_SESSION['current_company_id'] ?? null;
        $companies = [];
        if ($user) {
            $stmt = $pdo->prepare('SELECT companies.* FROM companies LEFT JOIN company_users ON company_users.company_id = companies.id AND company_users.user_id = ? WHERE companies.owner_user_id = ? OR company_users.user_id = ? ORDER BY companies.created_at ASC');
            $stmt->execute([$user['id'], $user['id'], $user['id']]);
            $companies = $stmt->fetchAll();
        }

        $warehouses = [];
        if ($companyId) {
            $stmt = $pdo->prepare('SELECT * FROM warehouses WHERE company_id = ? ORDER BY created_at ASC');
            $stmt->execute([$companyId]);
            $warehouses = $stmt->fetchAll();
        }

        $notifyCount = 0;
        $notifications = [];
        if ($user) {
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0');
            $stmt->execute([$user['id']]);
            $notifyCount = (int) $stmt->fetchColumn();

            $stmt = $pdo->prepare('SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 10');
            $stmt->execute([$user['id']]);
            $notifications = $stmt->fetchAll();
        }

        return [
            'user' => $user,
            'companies' => $companies,
            'warehouses' => $warehouses,
            'notifications' => $notifications,
            'notifyCount' => $notifyCount,
        ];
    }

    private function render($page, $data = [])
    {
        $shared = $this->sharedData();
        view('layouts/app', array_merge($shared, [
            'page' => $page,
        ], $data));
    }

    public function profile()
    {
        $this->render('pages/profile', ['pageTitle' => 'Профиль']);
    }

    public function updateProfile()
    {
        verify_csrf();
        $user = $this->currentUser();
        $name = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $username = trim($_POST['username'] ?? '');

        if ($name === '' || $surname === '' || $email === '' || $username === '') {
            $_SESSION['flash_error'] = 'Заполните все поля.';
            redirect('/app');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['flash_error'] = 'Неверный формат email.';
            redirect('/app');
        }

        $stmt = db()->prepare('SELECT COUNT(*) FROM users WHERE (email = ? OR username = ?) AND id != ?');
        $stmt->execute([$email, $username, $user['id']]);
        if ($stmt->fetchColumn() > 0) {
            $_SESSION['flash_error'] = 'Email или username уже используются.';
            redirect('/app');
        }

        $stmt = db()->prepare('UPDATE users SET name = ?, surname = ?, email = ?, username = ? WHERE id = ?');
        $stmt->execute([$name, $surname, $email, $username, $user['id']]);
        $_SESSION['flash_success'] = 'Профиль сохранен.';
        redirect('/app');
    }

    public function dashboard()
    {
        $this->render('pages/dashboard', ['pageTitle' => 'Дашборд']);
    }

    public function pos()
    {
        $this->render('pages/pos', ['pageTitle' => 'Касса']);
    }

    public function products()
    {
        $this->render('pages/products', ['pageTitle' => 'Товары']);
    }

    public function receipts()
    {
        $this->render('pages/receipts', ['pageTitle' => 'Приход']);
    }

    public function orders()
    {
        $this->render('pages/orders', ['pageTitle' => 'Заказы']);
    }

    public function warehouses()
    {
        $this->render('pages/warehouses', ['pageTitle' => 'Склады']);
    }

    public function services()
    {
        $this->render('pages/services', ['pageTitle' => 'Услуги']);
    }

    public function searchProducts()
    {
        $companyId = (int) ($_GET['company_id'] ?? 0);
        $query = trim($_GET['q'] ?? '');
        $results = [];
        if ($companyId && $query !== '') {
            $stmt = db()->prepare('SELECT id, name, article, sku, barcode, price FROM products WHERE company_id = ? AND (name LIKE ? OR article LIKE ? OR sku LIKE ? OR barcode LIKE ?) LIMIT 20');
            $like = '%' . $query . '%';
            $stmt->execute([$companyId, $like, $like, $like, $like]);
            $results = $stmt->fetchAll();
        }
        header('Content-Type: application/json');
        echo json_encode(['items' => $results]);
    }
}
