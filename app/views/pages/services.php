<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Услуги</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal">Добавить услугу</button>
</div>
<div class="card-soft p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Название</th>
                <th>Базовая цена</th>
                <th>Комментарий</th>
                <th>Статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Доставка</td>
                <td>500 ₽</td>
                <td>По городу</td>
                <td><span class="badge bg-success">Активна</span></td>
                <td><button class="btn btn-ghost btn-sm">Редактировать</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content card-soft">
            <div class="modal-header">
                <h5 class="modal-title">Новая услуга</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Название</label>
                    <input class="form-control" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Базовая цена</label>
                    <input class="form-control" type="text">
                </div>
                <div class="mb-3">
                    <label class="form-label">Комментарий</label>
                    <textarea class="form-control" rows="2"></textarea>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <label class="form-check-label">Активна</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Отмена</button>
                <button class="btn btn-primary" type="button">Сохранить</button>
            </div>
        </div>
    </div>
</div>
