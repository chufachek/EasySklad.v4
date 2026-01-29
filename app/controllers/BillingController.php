<?php
class BillingController
{
    public function index()
    {
        view('layouts/app', [
            'page' => 'pages/billing',
            'pageTitle' => 'Тарифы/Оплата',
        ]);
    }

    public function purchase()
    {
        verify_csrf();
        $plan = trim($_POST['plan'] ?? '');
        $plans = $GLOBALS['plans'] ?? [];
        if (!isset($plans[$plan])) {
            $_SESSION['flash_error'] = 'Неверный тариф.';
            redirect('/c/billing');
        }
        $price = $plans[$plan]['price'];
        $pdo = db();
        $stmt = $pdo->prepare('SELECT balance FROM users WHERE id = ?');
        $stmt->execute([$_SESSION['user_id']]);
        $balance = (float) $stmt->fetchColumn();
        if ($balance < $price) {
            $_SESSION['flash_error'] = 'Недостаточно средств.';
            redirect('/c/billing');
        }
        $stmt = $pdo->prepare('UPDATE users SET plan = ?, balance = balance - ? WHERE id = ?');
        $stmt->execute([$plan, $price, $_SESSION['user_id']]);
        $_SESSION['flash_success'] = 'Тариф обновлен.';
        redirect('/c/billing');
    }
}
