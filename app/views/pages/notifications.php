<?php
$userId = $_SESSION['user_id'] ?? null;
$items = [];
if ($userId) {
    $stmt = db()->prepare('SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC');
    $stmt->execute([$userId]);
    $items = $stmt->fetchAll();
}
?>
<div class="card-soft p-4">
    <h5 class="mb-3">Уведомления</h5>
    <?php if (empty($items)) : ?>
        <div class="text-muted">Пока нет уведомлений.</div>
    <?php else : ?>
        <?php foreach ($items as $notify) : ?>
            <div class="border-bottom py-2">
                <div class="fw-semibold"><?= htmlspecialchars($notify['title']) ?></div>
                <div class="small text-muted"><?= htmlspecialchars($notify['body']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
