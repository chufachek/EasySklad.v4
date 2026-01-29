(function () {
  const form = document.querySelector('form[action="/c/context"]');
  if (!form) return;
  form.querySelectorAll('select').forEach((select) => {
    select.addEventListener('change', () => form.submit());
  });
})();
