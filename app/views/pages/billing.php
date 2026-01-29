<?php
$plans = $GLOBALS['plans'] ?? [];
?>
<div class="row g-4">
    <?php foreach ($plans as $planName => $planData) : ?>
        <div class="col-md-6 col-lg-3">
            <div class="card-soft p-3 h-100">
                <h5><?= htmlspecialchars($planName) ?></h5>
                <div class="text-muted mb-2">Оборот: <?= $planData['turnover'] === -1 ? '∞' : number_format($planData['turnover'], 0, '.', ' ') ?> ₽</div>
                <ul class="small text-muted">
                    <li>Компаний: <?= $planData['companies'] === -1 ? '∞' : $planData['companies'] ?></li>
                    <li>Складов: <?= $planData['warehouses'] === -1 ? '∞' : $planData['warehouses'] ?></li>
                    <li>Товаров: <?= $planData['products'] === -1 ? '∞' : $planData['products'] ?></li>
                    <li>Пользователей: <?= $planData['users'] === -1 ? '∞' : $planData['users'] ?></li>
                </ul>
                <div class="fw-semibold mb-2"><?= $planData['price'] === 0 ? 'Бесплатно' : number_format($planData['price'], 0, '.', ' ') . ' ₽/мес' ?></div>
                <form method="post" action="/c/billing/purchase">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                    <input type="hidden" name="plan" value="<?= htmlspecialchars($planName) ?>">
                    <button class="btn btn-primary w-100" type="submit">Выбрать</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="card-soft p-3 mt-4">
    <h5>Пополнение баланса</h5>
    <p class="text-muted">Manual top-up пока не реализован.</p>
    <button class="btn btn-ghost" type="button">Пополнить</button>
</div>
