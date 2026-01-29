# Easy склад (PHP MVP)

## Запуск

1. Установите зависимости:
   ```bash
   composer install
   ```
2. Создайте базу данных и импортируйте `database.sql`.
3. Укажите переменные окружения:
   - `DB_HOST`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASS`
4. Настройте корень сайта на папку `/public`.

## Маршруты

- `/auth/login` — вход
- `/auth/register` — регистрация
- `/app` — профиль
- `/c/dashboard` — дашборд
- `/c/products` — товары
- `/c/warehouses` — склады
- `/c/receipts` — приход
- `/c/orders` — заказы
- `/c/pos` — касса
- `/c/services` — услуги
- `/c/billing` — тарифы/оплата
- `/app/notifications` — уведомления
