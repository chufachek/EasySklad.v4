<?php
$companyId = $_SESSION['current_company_id'] ?? null;
?>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card-soft p-4">
            <h5 class="mb-3">Профиль</h5>
            <form method="post" action="/app/profile">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Имя</label>
                        <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Фамилия</label>
                        <input class="form-control" type="text" name="surname" value="<?= htmlspecialchars($user['surname'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control" type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                </div>
                <button class="btn btn-primary" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-soft p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Компании</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#companyModal">Создать компанию</button>
            </div>
            <?php if (empty($companies)) : ?>
                <div class="text-muted">У вас пока нет компаний.</div>
            <?php else : ?>
                <div class="row g-3">
                    <?php foreach ($companies as $company) : ?>
                        <div class="col-12">
                            <div class="border rounded p-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-semibold"><?= htmlspecialchars($company['name']) ?></div>
                                    <div class="small text-muted"><?= htmlspecialchars($company['address'] ?? '') ?></div>
                                </div>
                                <?php if ((int) $companyId === (int) $company['id']) : ?>
                                    <span class="badge-soft">Текущая</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="companyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content card-soft">
            <div class="modal-header">
                <h5 class="modal-title">Новая компания</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="/c/companies/create">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ИНН</label>
                        <input class="form-control" type="text" name="inn">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Адрес</label>
                        <input class="form-control" type="text" name="address">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Отмена</button>
                    <button class="btn btn-primary" type="submit">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
