function initStickyCta() {
    const cta = document.querySelector('[data-sticky-cta]');
    const leadForm = document.querySelector('#lead-form');

    if (!cta || !leadForm) return;

    const observer = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting) {
                cta.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none');
            } else {
                cta.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
            }
        },
        { threshold: 0.1 }
    );

    observer.observe(leadForm);
}

document.addEventListener('DOMContentLoaded', initStickyCta);