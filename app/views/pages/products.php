<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
    <div class="d-flex gap-2">
        <input class="form-control" type="text" placeholder="Поиск товара">
        <select class="form-select" data-choices>
            <option value="">Категория</option>
            <option>Сыры</option>
            <option>Напитки</option>
        </select>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">Создать товар</button>
        <button class="btn btn-ghost">Импорт</button>
        <button class="btn btn-ghost">Экспорт</button>
    </div>
</div>
<div class="card-soft p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Артикул</th>
                <th>SKU</th>
                <th>Штрихкод</th>
                <th>Цена</th>
                <th>Остаток</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Эспрессо бленд</td>
                <td>Кофе</td>
                <td>ESP-01</td>
                <td>SKU-2331</td>
                <td>482001234</td>
                <td>350,00 ₽</td>
                <td>—</td>
                <td><span class="badge bg-success">Активен</span></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card-soft">
            <div class="modal-header">
                <h5 class="modal-title">Новый товар</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Название</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Категория</label>
                        <select class="form-select" data-choices>
                            <option value="">Без категории</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Артикул</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">SKU</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Штрихкод</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Ед. изм.</label>
                        <select class="form-select" data-choices>
                            <option>шт</option>
                            <option>кг</option>
                            <option>м</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Цена</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Себестоимость</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <label class="form-check-label">Активный товар</label>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Отмена</button>
                <button class="btn btn-primary" type="button">Сохранить</button>
            </div>
        </div>
    </div>
</div>
