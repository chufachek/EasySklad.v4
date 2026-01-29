function formatMoney(value) {
  const amount = Number(value || 0);
  return amount.toLocaleString('ru-RU', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' ₽';
}

function parseMoney(value) {
  if (!value) return 0;
  const normalized = value.toString().replace(/[^0-9,\.]/g, '').replace(',', '.');
  return parseFloat(normalized) || 0;
}

function formatQty(value) {
  return Number(value || 0).toLocaleString('ru-RU', { minimumFractionDigits: 0, maximumFractionDigits: 3 });
}
