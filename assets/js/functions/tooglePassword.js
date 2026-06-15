export function tooglePassword() {
    document.querySelectorAll('[data-password-toggle]').forEach((button) => {
        const wrapper = button.closest('[data-password-field]');
        const input = wrapper ? wrapper.querySelector('[data-password-input]') : null;

        if (!input) {
            return;
        }

        updateButton(button, input.type === 'text');
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest) {
            return;
        }

        const button = event.target.closest('[data-password-toggle]');

        if (!button) {
            return;
        }

        const wrapper = button.closest('[data-password-field]');
        const input = wrapper ? wrapper.querySelector('[data-password-input]') : null;

        if (!input) {
            return;
        }

        const isVisible = input.type === 'password';

        input.type = isVisible ? 'text' : 'password';
        updateButton(button, isVisible);
    });
}

function updateButton(button, isVisible) {
    button.textContent = isVisible ? '🙈' : '👁️';
    button.setAttribute('aria-label', isVisible ? 'Sembunyikan password' : 'Tampilkan password');
    button.setAttribute('aria-pressed', String(isVisible));
}
