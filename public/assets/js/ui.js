(function () {
  document.querySelectorAll('[data-loading-btn]').forEach((button) => {
    button.addEventListener('click', () => {
      const label = button.dataset.loadingText || 'Загрузка...';
      button.dataset.originalText = button.innerHTML;
      button.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span>${label}`;
      button.disabled = true;
      setTimeout(() => {
        button.innerHTML = button.dataset.originalText;
        button.disabled = false;
      }, 1500);
    });
  });
})();
