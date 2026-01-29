(function () {
  const form = document.querySelector('[data-auth-form]');
  if (!form) return;
  form.addEventListener('submit', (event) => {
    const required = form.querySelectorAll('[required]');
    let valid = true;
    required.forEach((input) => {
      if (!input.value.trim()) {
        valid = false;
        input.classList.add('is-invalid');
      } else {
        input.classList.remove('is-invalid');
      }
    });

    if (!valid) {
      event.preventDefault();
    }
  });
})();
