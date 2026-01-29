<h3 class="mb-3">Регистрация</h3>
<p class="text-muted mb-4">Создайте аккаунт для управления складом.</p>
<form method="post" data-auth-form>
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Имя</label>
            <input class="form-control" type="text" name="name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Фамилия</label>
            <input class="form-control" type="text" name="surname" required>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" type="email" name="email" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input class="form-control" type="text" name="username" required>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Пароль</label>
            <input class="form-control" type="password" name="password" minlength="8" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Повтор пароля</label>
            <input class="form-control" type="password" name="password_confirm" minlength="8" required>
        </div>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="agree" id="agree" required>
        <label class="form-check-label" for="agree">Я принимаю условия сервиса</label>
    </div>
    <button class="btn btn-primary w-100" type="submit">Создать аккаунт</button>
</form>
<div class="mt-3">
    <a href="/auth/login" class="text-decoration-none">Уже есть аккаунт?</a>
</div>
