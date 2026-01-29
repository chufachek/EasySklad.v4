<?php
$pdo = db();
$user = $user ?? null;
if (!$user && !empty($_SESSION['user_id'])) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}

$companies = $companies ?? [];
if (!$companies && $user) {
    $stmt = $pdo->prepare('SELECT companies.* FROM companies LEFT JOIN company_users ON company_users.company_id = companies.id AND company_users.user_id = ? WHERE companies.owner_user_id = ? OR company_users.user_id = ? ORDER BY companies.created_at ASC');
    $stmt->execute([$user['id'], $user['id'], $user['id']]);
    $companies = $stmt->fetchAll();
}

$companyId = $_SESSION['current_company_id'] ?? null;
$warehouses = $warehouses ?? [];
if (!$warehouses && $companyId) {
    $stmt = $pdo->prepare('SELECT * FROM warehouses WHERE company_id = ? ORDER BY created_at ASC');
    $stmt->execute([$companyId]);
    $warehouses = $stmt->fetchAll();
}

$notifyCount = $notifyCount ?? 0;
$notifications = $notifications ?? [];
if ($user && !$notifications) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0');
    $stmt->execute([$user['id']]);
    $notifyCount = (int) $stmt->fetchColumn();

    $stmt = $pdo->prepare('SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT 10');
    $stmt->execute([$user['id']]);
    $notifications = $stmt->fetchAll();
}

$flashSuccess = $_SESSION['flash_success'] ?? null;
$flashError = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

$title = $title ?? APP_NAME;
$pageTitle = $pageTitle ?? 'Профиль';
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> — <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">
    <link href="/assets/styles/theme.css" rel="stylesheet">
    <link href="/assets/styles/app.css" rel="stylesheet">
</head>
<body>
<div class="toast-container">
    <?php if ($flashSuccess) : ?>
        <div class="toast align-items-center text-bg-success border-0 show mb-2">
            <div class="d-flex">
                <div class="toast-body"><?= htmlspecialchars($flashSuccess) ?></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($flashError) : ?>
        <div class="toast align-items-center text-bg-danger border-0 show mb-2">
            <div class="d-flex">
                <div class="toast-body"><?= htmlspecialchars($flashError) ?></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="app-shell">
    <aside class="sidebar p-3">
        <div class="d-flex align-items-center gap-2 mb-4">
            <div class="fw-bold">Easy <span class="brand-text">склад</span></div>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" href="/c/dashboard"><i class="bi bi-grid"></i><span>Дашборд</span></a>
            <a class="nav-link" href="/c/pos"><i class="bi bi-cash-coin"></i><span>Касса</span></a>
            <a class="nav-link" href="/c/products"><i class="bi bi-box"></i><span>Товары</span></a>
            <a class="nav-link" href="/c/receipts"><i class="bi bi-download"></i><span>Приход</span></a>
            <a class="nav-link" href="/c/orders"><i class="bi bi-receipt"></i><span>Заказы</span></a>
            <a class="nav-link" href="/c/warehouses"><i class="bi bi-building"></i><span>Склады</span></a>
            <a class="nav-link" href="/c/services"><i class="bi bi-lightning"></i><span>Услуги</span></a>
            <a class="nav-link" href="/c/billing"><i class="bi bi-credit-card"></i><span>Тарифы/Оплата</span></a>
            <a class="nav-link" href="/app"><i class="bi bi-gear"></i><span>Настройки</span></a>
        </nav>
    </aside>
    <div class="content">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <button class="btn btn-ghost" data-sidebar-toggle type="button"><i class="bi bi-list"></i></button>
                <form method="post" action="/c/context" class="d-flex gap-2 flex-wrap align-items-center">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                    <select name="company_id" class="form-select" data-choices <?= empty($companies) ? 'disabled' : '' ?>>
                        <?php if (empty($companies)) : ?>
                            <option value="">Создайте компанию</option>
                        <?php else : ?>
                            <?php foreach ($companies as $company) : ?>
                                <option value="<?= $company['id'] ?>" <?= $companyId == $company['id'] ? 'selected' : '' ?>><?= htmlspecialchars($company['name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <select name="warehouse_id" class="form-select" data-choices <?= empty($warehouses) ? 'disabled' : '' ?>>
                        <?php if (empty($warehouses)) : ?>
                            <option value="">Создайте склад</option>
                        <?php else : ?>
                            <?php foreach ($warehouses as $warehouse) : ?>
                                <option value="<?= $warehouse['id'] ?>" <?= ($_SESSION['current_warehouse_id'] ?? null) == $warehouse['id'] ? 'selected' : '' ?>><?= htmlspecialchars($warehouse['name']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <button class="btn btn-primary" type="submit">Ок</button>
                </form>
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" placeholder="Поиск">
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-ghost" data-theme-toggle type="button"><i class="bi bi-moon"></i></button>
                <div class="dropdown">
                    <button class="btn btn-ghost position-relative" data-bs-toggle="dropdown" type="button">
                        <i class="bi bi-bell"></i>
                        <?php if ($notifyCount > 0) : ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= $notifyCount ?></span>
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 320px;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong>Уведомления</strong>
                            <a href="/app/notifications" class="small text-decoration-none">Все</a>
                        </div>
                        <?php if (empty($notifications)) : ?>
                            <div class="text-muted">Пока нет уведомлений.</div>
                        <?php else : ?>
                            <?php foreach ($notifications as $notify) : ?>
                                <div class="border-bottom py-2">
                                    <div class="fw-semibold"><?= htmlspecialchars($notify['title']) ?></div>
                                    <div class="small text-muted"><?= htmlspecialchars($notify['body']) ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-ghost" data-bs-toggle="dropdown" type="button">
                        <i class="bi bi-person-circle"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 280px;">
                        <?php if ($user) : ?>
                            <div class="fw-semibold"><?= htmlspecialchars($user['name'] . ' ' . $user['surname']) ?> <span class="text-muted">@<?= htmlspecialchars($user['username']) ?></span></div>
                            <div class="small text-muted mb-2">ID: <?= $user['id'] ?></div>
                            <div class="small text-muted mb-3">Тариф: <?= htmlspecialchars($user['plan']) ?> · Баланс: <?= number_format((float)$user['balance'], 2, '.', ' ') ?> ₽</div>
                        <?php endif; ?>
                        <a class="dropdown-item" href="/app">Профиль</a>
                        <a class="dropdown-item" href="/c/billing">Тарифы/Оплата</a>
                        <form method="post" action="/auth/logout">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <button class="dropdown-item" type="submit">Выйти</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-grow-1">
            <div class="page-header">
                <h2 class="mb-0"><?= htmlspecialchars($pageTitle) ?></h2>
                <div class="breadcrumbs">Компания / Раздел</div>
            </div>
            <div class="p-4">
                <?php include __DIR__ . '/../' . $page . '.php'; ?>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="/assets/js/utils.js"></script>
<script src="/assets/js/app.js"></script>
<script src="/assets/js/ui.js"></script>
<script src="/assets/js/context.js"></script>
<script src="/assets/js/profile.js"></script>
</body>
</html>
