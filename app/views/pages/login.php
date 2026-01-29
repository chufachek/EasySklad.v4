<h3 class="mb-3">Вход в Easy склад</h3>
<p class="text-muted mb-4">Введите email или username и пароль.</p>
<form method="post" data-auth-form>
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <div class="mb-3">
        <label class="form-label">Email или Username</label>
        <input class="form-control" type="text" name="login" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Пароль</label>
        <input class="form-control" type="password" name="password" required>
    </div>
    <button class="btn btn-primary w-100" type="submit">Войти</button>
</form>
<div class="d-flex justify-content-between mt-3">
    <a href="/auth/register" class="text-decoration-none">Создать аккаунт</a>
    <a href="/auth/forgot" class="text-decoration-none">Забыли пароль?</a>
</div>
