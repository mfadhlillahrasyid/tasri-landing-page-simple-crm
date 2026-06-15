export function confirmModal() {
    const modal = document.getElementById('confirm-modal');
    const title = document.getElementById('confirm-modal-title');
    const message = document.getElementById('confirm-modal-message');
    const confirmButton = modal ? modal.querySelector('[data-modal-confirm]') : null;
    const cancelButtons = modal ? modal.querySelectorAll('[data-modal-cancel]') : [];
    let pendingForm = null;

    function open(form) {
        if (!modal || !title || !message || !confirmButton) {
            return false;
        }

        pendingForm = form;
        title.textContent = form.getAttribute('data-confirm-title') || 'Konfirmasi Aksi';
        message.textContent = form.getAttribute('data-confirm') || 'Lanjutkan aksi ini?';
        confirmButton.textContent = form.getAttribute('data-confirm-action') || 'Lanjutkan';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.setAttribute('aria-hidden', 'false');
        confirmButton.focus();

        return true;
    }

    function close() {
        if (!modal) {
            return;
        }

        pendingForm = null;
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.setAttribute('aria-hidden', 'true');
    }

    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();

            if (!open(form) && window.confirm(form.getAttribute('data-confirm') || 'Lanjutkan aksi ini?')) {
                form.dataset.confirmed = 'true';
                form.submit();
            }
        });
    });

    if (confirmButton) {
        confirmButton.addEventListener('click', () => {
            if (!pendingForm) {
                return;
            }

            pendingForm.dataset.confirmed = 'true';
            pendingForm.submit();
        });
    }

    cancelButtons.forEach((button) => {
        button.addEventListener('click', close);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close();
        }
    });
}
