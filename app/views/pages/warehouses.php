<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Склады</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#warehouseModal">Создать склад</button>
</div>
<div class="card-soft p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Название</th>
                <th>Адрес</th>
                <th>Комментарий</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Основной склад</td>
                <td>Москва, ул. Пример</td>
                <td>24/7</td>
                <td><span class="badge bg-primary">Текущий</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="warehouseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content card-soft">
            <div class="modal-header">
                <h5 class="modal-title">Новый склад</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Название</label>
                    <input class="form-control" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Адрес</label>
                    <input class="form-control" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Комментарий</label>
                    <textarea class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Отмена</button>
                <button class="btn btn-primary" type="button">Создать</button>
            </div>
        </div>
    </div>
</div>
