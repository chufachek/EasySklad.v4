(function () {
  const root = document.documentElement;
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    root.setAttribute('data-theme', savedTheme);
  }

  const toggle = document.querySelector('[data-theme-toggle]');
  if (toggle) {
    const currentTheme = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
    toggle.innerHTML = currentTheme === 'dark' ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';
    toggle.addEventListener('click', () => {
      const current = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
      const next = current === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      localStorage.setItem('theme', next);
      toggle.innerHTML = next === 'dark' ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';
    });
  }

  const sidebar = document.querySelector('.sidebar');
  const collapseBtn = document.querySelector('[data-sidebar-toggle]');
  if (sidebar && collapseBtn) {
    const stored = localStorage.getItem('sidebar');
    if (stored === 'collapsed') {
      sidebar.classList.add('collapsed');
    }
    collapseBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      localStorage.setItem('sidebar', sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded');
    });
  }

  window.showToast = function (message, type = 'primary') {
    const container = document.querySelector('.toast-container');
    if (!container) return;
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-bg-${type} border-0 show mb-2`;
    toast.innerHTML = `<div class="d-flex"><div class="toast-body">${message}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>`;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
  };

  if (window.Choices) {
    document.querySelectorAll('select[data-choices]')
      .forEach((select) => {
        if (!select.options.length) {
          select.disabled = true;
          return;
        }
        new Choices(select, {
          searchEnabled: true,
          itemSelectText: '',
          shouldSort: false,
        });
      });
  }
})();
