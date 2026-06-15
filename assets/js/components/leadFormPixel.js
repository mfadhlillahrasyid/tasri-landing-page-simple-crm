document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-lead-form]');

    if (!form) {
        return;
    }

    const submitButton = form.querySelector('[data-lead-submit]');
    const requiredFields = Array.from(form.querySelectorAll('[required]'));
    const pixelEvent = form.getAttribute('data-pixel-event') || 'Purchase';
    let hasTracked = false;

    if (!submitButton || requiredFields.length === 0) {
        return;
    }

    function isComplete() {
        return requiredFields.every((field) => field.value.trim() !== '');
    }

    function syncButton() {
        submitButton.disabled = !isComplete();
    }

    requiredFields.forEach((field) => {
        field.addEventListener('input', syncButton);
        field.addEventListener('change', syncButton);
    });

    form.addEventListener('submit', (event) => {
        syncButton();

        if (submitButton.disabled || !form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }

        submitButton.disabled = true;

        if (!hasTracked && typeof fbq === 'function') {
            fbq('track', pixelEvent);
            hasTracked = true;
        }
    });

    syncButton();
});
