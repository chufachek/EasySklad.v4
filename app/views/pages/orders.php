<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Заказы</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">Создать заказ</button>
</div>
<div class="card-soft p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>№</th>
                <th>Дата</th>
                <th>Клиент</th>
                <th>Склад</th>
                <th>Статус</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>#209</td>
                <td>12.04.2024</td>
                <td>Незнакомый</td>
                <td>Основной</td>
                <td><span class="badge bg-success">Shipped</span></td>
                <td>8 400 ₽</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content card-soft">
            <div class="modal-header">
                <h5 class="modal-title">Новый заказ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Клиент</label>
                        <input class="form-control" type="text" placeholder="Незнакомый">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Скидка</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Комментарий</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="border rounded p-3 mb-3">
                    <div class="fw-semibold mb-2">Товары</div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <input class="form-control" placeholder="Товар">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" type="number" placeholder="Кол-во">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input class="form-control" type="text" placeholder="Цена">
                        </div>
                    </div>
                </div>
                <div class="border rounded p-3">
                    <div class="fw-semibold mb-2">Услуги</div>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input class="form-control" placeholder="Услуга">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input class="form-control" type="number" placeholder="Кол-во">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input class="form-control" type="text" placeholder="Цена">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input class="form-control" type="number" placeholder="Мин.">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Отмена</button>
                <button class="btn btn-primary" type="button">Подтвердить</button>
            </div>
        </div>
    </div>
</div>
