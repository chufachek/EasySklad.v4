<?php
class AuthController
{
    public function login()
    {
        if (!empty($_SESSION['user_id'])) {
            redirect('/app');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verify_csrf();
            $login = trim($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($login === '' || $password === '') {
                $error = 'Введите логин и пароль.';
            } else {
                $stmt = db()->prepare('SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1');
                $stmt->execute([$login, $login]);
                $user = $stmt->fetch();
                if ($user && password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id'] = $user['id'];
                    redirect('/app');
                }
                $error = 'Неверные данные для входа.';
            }
        }

        view('layouts/auth', [
            'title' => 'Вход',
            'page' => 'pages/login',
            'error' => $error,
        ]);
    }

    public function register()
    {
        if (!empty($_SESSION['user_id'])) {
            redirect('/app');
        }

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            verify_csrf();
            $name = trim($_POST['name'] ?? '');
            $surname = trim($_POST['surname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';
            $agree = isset($_POST['agree']);

            if ($name === '' || $surname === '' || $email === '' || $username === '' || $password === '') {
                $error = 'Заполните все обязательные поля.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Неверный формат email.';
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $error = 'Username должен содержать латиницу, цифры или _.';
            } elseif (strlen($password) < 8) {
                $error = 'Пароль должен быть не менее 8 символов.';
            } elseif ($password !== $passwordConfirm) {
                $error = 'Пароли не совпадают.';
            } elseif (!$agree) {
                $error = 'Нужно согласиться с условиями.';
            } else {
                $stmt = db()->prepare('SELECT COUNT(*) FROM users WHERE email = ? OR username = ?');
                $stmt->execute([$email, $username]);
                if ($stmt->fetchColumn() > 0) {
                    $error = 'Email или username уже используются.';
                } else {
                    $hash = password_hash($password, PASSWORD_BCRYPT);
                    $plan = 'Free';
                    $balance = 0;
                    $trialStart = null;
                    $trialEnd = null;

                    $stmt = db()->prepare('INSERT INTO users (name, surname, email, username, password_hash, plan, balance, trial_start, trial_end, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
                    $stmt->execute([$name, $surname, $email, $username, $hash, $plan, $balance, $trialStart, $trialEnd]);
                    redirect('/auth/login');
                }
            }
        }

        view('layouts/auth', [
            'title' => 'Регистрация',
            'page' => 'pages/register',
            'error' => $error,
        ]);
    }

    public function logout()
    {
        verify_csrf();
        session_destroy();
        redirect('/auth/login');
    }
}
