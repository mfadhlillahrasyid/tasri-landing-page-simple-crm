export function customSelect() {
    document.querySelectorAll('[data-custom-select]').forEach((select) => {
        const nativeSelect = select.querySelector('[data-custom-select-native]');
        const trigger = select.querySelector('[data-custom-select-trigger]');
        const triggerLabel = select.querySelector('[data-custom-select-label]');
        const icon = select.querySelector('[data-custom-select-icon]');
        const menu = select.querySelector('[data-custom-select-menu]');
        const options = select.querySelectorAll('[data-custom-select-option]');

        if (!nativeSelect || !trigger || !triggerLabel || !menu) {
            return;
        }

        function close() {
            menu.classList.add('hidden');
            trigger.setAttribute('aria-expanded', 'false');
            if (icon) {
                icon.classList.remove('rotate-180');
            }
        }

        function open() {
            menu.classList.remove('hidden');
            trigger.setAttribute('aria-expanded', 'true');
            if (icon) {
                icon.classList.add('rotate-180');
            }
        }

        function setSelected(option) {
            const value = option.getAttribute('data-value') || '';
            const label = option.textContent.trim();

            nativeSelect.value = value;
            triggerLabel.textContent = label;

            options.forEach((item) => {
                const isSelected = item === option;

                item.dataset.selected = String(isSelected);
                item.setAttribute('aria-selected', String(isSelected));
                item.classList.toggle('bg-blue-50', isSelected);
                item.classList.toggle('text-blue-700', isSelected);
            });

            nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));
            close();
        }

        trigger.addEventListener('click', () => {
            const isOpen = !menu.classList.contains('hidden');

            if (isOpen) {
                close();
                return;
            }

            open();
        });

        options.forEach((option) => {
            option.addEventListener('click', () => setSelected(option));
        });

        document.addEventListener('click', (event) => {
            if (!select.contains(event.target)) {
                close();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                close();
            }
        });
    });
}
