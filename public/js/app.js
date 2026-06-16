// Queen Laundry - App JS
document.addEventListener('DOMContentLoaded', function() {
    // Modal open/close
    document.querySelectorAll('[data-modal-open]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-modal-open');
            const m = document.getElementById(id);
            if (m) m.classList.add('open');
        });
    });
    document.querySelectorAll('[data-modal-close],.modal-overlay').forEach(el => {
        el.addEventListener('click', (e) => {
            if (e.target === el) el.closest('.modal-overlay')?.classList.remove('open');
        });
    });
    document.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', () => btn.closest('.modal-overlay')?.classList.remove('open'));
    });

    // Auto-dismiss alerts
    document.querySelectorAll('.alert[data-auto-dismiss]').forEach(a => {
        setTimeout(() => a.remove(), 4000);
    });

    // Filter tabs
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            const group = tab.closest('.filter-tabs');
            group?.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
        });
    });
});
