export function customerModal() {
    document.addEventListener('click', (event) => {
        if (!event.target.closest) {
            return;
        }

        const openButton = event.target.closest('[data-customer-modal-open]');

        if (!openButton) {
            return;
        }

        const modal = document.getElementById(openButton.getAttribute('data-customer-modal-open'));

        if (!modal) {
            return;
        }

        if (modal.showModal) {
            modal.showModal();
            return;
        }

        modal.setAttribute('open', 'open');
    });
}
