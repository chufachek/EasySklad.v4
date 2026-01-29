<div class="card-soft p-4">
    <h5 class="mb-3">Команда</h5>
    <form class="row g-3" method="post" action="/c/invitations/send">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="col-md-5">
            <input class="form-control" type="email" name="email" placeholder="Email сотрудника" required>
        </div>
        <div class="col-md-4">
            <select class="form-select" name="role" data-choices>
                <option value="viewer">Viewer</option>
                <option value="cashier">Cashier</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100" type="submit">Отправить</button>
        </div>
    </form>
    <div class="mt-4 text-muted">Список участников появится здесь.</div>
</div>
