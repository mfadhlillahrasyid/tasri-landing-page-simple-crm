export function dropzone() {
    document.querySelectorAll('[data-dropzone]').forEach((zone) => {
        const input = zone.querySelector('[data-dropzone-input]');
        const preview = zone.querySelector('[data-dropzone-preview]');
        const error = zone.querySelector('[data-dropzone-error]');
        const maxFiles = Number(zone.getAttribute('data-dropzone-max-files') || 1);
        const maxSize = Number(zone.getAttribute('data-dropzone-max-size') || 2097152);
        const whenName = zone.getAttribute('data-dropzone-when-name');
        const whenValue = zone.getAttribute('data-dropzone-when-value');

        if (!input || !preview || !error) {
            return;
        }

        function setError(message) {
            error.textContent = message;
            error.classList.toggle('hidden', message === '');
        }

        function render(files) {
            preview.innerHTML = '';

            files.forEach((file) => {
                const image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                image.className = 'h-16 w-16 rounded-lg object-cover';
                preview.appendChild(image);
            });
        }

        function toggleVisibility() {
            if (!whenName || !whenValue) {
                return;
            }

            const form = zone.closest('form');
            const field = form ? form.querySelector(`[name="${whenName}"]`) : null;
            const isVisible = field && field.value === whenValue;

            zone.classList.toggle('hidden', !isVisible);

            if (!isVisible) {
                input.value = '';
                setError('');
            }
        }

        input.addEventListener('change', () => {
            const files = Array.from(input.files || []);

            if (files.length > maxFiles) {
                input.value = '';
                setError(`Maksimal ${maxFiles} gambar.`);
                return;
            }

            const invalidFile = files.find((file) => !file.type.startsWith('image/') || file.size > maxSize);

            if (invalidFile) {
                input.value = '';
                setError('File harus gambar dan maksimal 2MB.');
                return;
            }

            setError('');
            render(files);
        });

        if (whenName && whenValue) {
            const form = zone.closest('form');
            const field = form ? form.querySelector(`[name="${whenName}"]`) : null;

            if (field) {
                field.addEventListener('change', toggleVisibility);
            }
            toggleVisibility();
        }
    });
}
