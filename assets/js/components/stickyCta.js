function initStickyCta() {
    const cta = document.querySelector('[data-sticky-cta]');
    const leadForm = document.querySelector('#lead-form');

    if (!cta || !leadForm) return;

    const hide = () => cta.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none');
    const show = () => cta.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');

    hide();

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        const formTop = leadForm.getBoundingClientRect().top + scrollY;

        if (scrollY < 50) {
            hide();
        } else if (scrollY >= formTop) {
            hide();
        } else {
            show();
        }
    }, { passive: true });
}

document.addEventListener('DOMContentLoaded', initStickyCta);