import './bootstrap';

const AdminUI = {
    init() {
        this.bindSidebarToggle();
        this.bindDropdowns();
        this.registerModalHandlers();
        this.observeFilters();
        this.refreshStats();
        setInterval(() => this.refreshStats(), 60 * 1000);
    },

    bindSidebarToggle() {
        const shell = document.querySelector('.admin-shell');
        const toggleBtn = document.querySelector('[data-sidebar-toggle]');

        if (!shell || !toggleBtn) {
            return;
        }

        toggleBtn.addEventListener('click', () => {
            shell.classList.toggle('sidebar-collapsed');
        });
    },

    bindDropdowns() {
        document.addEventListener('click', (event) => {
            const dropdown = document.querySelector('.user-pill');
            const menu = document.querySelector('.user-menu');

            if (!dropdown || !menu) {
                return;
            }

            const clickedInside = dropdown.contains(event.target);

            if (clickedInside) {
                menu.classList.toggle('active');
            } else {
                menu.classList.remove('active');
            }
        });
    },

    registerModalHandlers() {
        document.querySelectorAll('[data-modal-trigger]').forEach((btn) => {
            btn.addEventListener('click', (event) => {
                event.preventDefault();
                const target = btn.getAttribute('data-modal-trigger');
                const modal = document.getElementById(target);
                if (modal) {
                    modal.classList.add('open');
                }
            });
        });

        document.querySelectorAll('.admin-modal').forEach((modal) => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.hasAttribute('data-close-modal')) {
                    modal.classList.remove('open');
                }
            });
        });
    },

    observeFilters() {
        document.querySelectorAll('[data-table-search]').forEach((input) => {
            input.addEventListener('input', () => {
                const term = input.value.toLowerCase();
                const target = document.querySelector(input.dataset.tableSearch);
                if (!target) {
                    return;
                }

                target.querySelectorAll('tbody tr').forEach((row) => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(term) ? '' : 'none';
                });
            });
        });
    },

    refreshStats() {
        if (!document.querySelector('[data-dashboard-stats]')) {
            return;
        }

        fetch('/admin/dashboard/stats', {
            headers: {
                Accept: 'application/json',
            },
        })
            .then((response) => response.json())
            .then((stats) => {
                document.querySelectorAll('[data-stat-key]').forEach((element) => {
                    const key = element.getAttribute('data-stat-key');
                    if (stats[key] !== undefined) {
                        element.textContent = new Intl.NumberFormat().format(stats[key]);
                    }
                });
            })
            .catch(() => {
                // fail quietly
            });
    },
};

document.addEventListener('DOMContentLoaded', () => {
    AdminUI.init();
});


