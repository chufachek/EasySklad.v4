<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Приход</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#receiptModal">Создать приход</button>
</div>
<div class="card-soft p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>№</th>
                <th>Дата</th>
                <th>Склад</th>
                <th>Статус</th>
                <th>Сумма</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>#102</td>
                <td>12.04.2024</td>
                <td>Основной</td>
                <td><span class="badge bg-secondary">Draft</span></td>
                <td>24 000 ₽</td>
                <td><button class="btn btn-ghost btn-sm">Открыть</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="receiptModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-soft">
            <div class="modal-header">
                <h5 class="modal-title">Новый приход</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Дата</label>
                        <input class="form-control" type="date" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Поставщик</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Комментарий</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="border rounded p-3">
                    <div class="text-muted mb-2">Позиции</div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Товар / скан">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" type="number" placeholder="Кол-во">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" type="text" placeholder="Цена">
                        </div>
                    </div>
                    <button class="btn btn-ghost btn-sm">Добавить позицию</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Отмена</button>
                <button class="btn btn-primary" type="button">Провести</button>
            </div>
        </div>
    </div>
</div>
