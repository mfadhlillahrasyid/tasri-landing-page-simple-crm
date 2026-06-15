const faqs = [
    {
        question: 'Apa benar rumahnya bisa bebas desain?',
        answer: 'Ya. Taman Asoka Asri mengusung konsep bebas desain, sehingga kamu dapat merencanakan rumah sesuai kebutuhan dan gaya hidup keluarga. Proses desain tetap mengikuti ketentuan teknis kawasan agar lingkungan tetap tertata dan nyaman.',
    },
    {
        question: 'Kalau saya belum punya desain rumah, bagaimana?',
        answer: 'Tidak perlu khawatir. Tersedia free desain arsitek yang akan membantu merancang konsep rumah sesuai kebutuhan, mulai dari tata ruang hingga tampilan fasad bangunan.',
    },
    {
        question: 'Apakah tersedia pilihan tanah kavling?',
        answer: 'Ya. Taman Asoka Asri menyediakan pilihan kavling untuk kamu yang ingin mengamankan lahan terlebih dahulu sebelum merencanakan pembangunan rumah.',
    },
    {
        question: 'Apa keunggulan Taman Asoka Asri dibanding perumahan lain?',
        answer: 'Selain lokasi strategis di Kota Medan, Taman Asoka Asri menawarkan konsep bebas desain rumah, free desain arsitek, keamanan 24 jam, fasilitas kawasan, serta lingkungan yang terus dijaga dan dirawat secara berkala.',
    },
    {
        question: 'Bagaimana cara melihat lokasi secara langsung?',
        answer: 'Kamu bisa mengisi form atau menghubungi tim kami untuk menjadwalkan survey lokasi sesuai waktu yang diinginkan.',
    },
];

function createAccordionItem(faq, index) {
    const item = document.createElement('article');
    const heading = document.createElement('h3');
    const trigger = document.createElement('button');
    const question = document.createElement('span');
    const icon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    const iconPath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    const panel = document.createElement('div');
    const panelInner = document.createElement('div');
    const answer = document.createElement('p');

    item.className = 'rounded-xl border border-slate-200 bg-white';
    item.dataset.accordionItem = '';
    heading.className = 'text-sm sm:text-base leading-snug tracking-tight';

    if (index === 0) {
        item.dataset.accordionOpen = 'true';
    }

    trigger.type = 'button';
    trigger.className = 'flex w-full cursor-pointer items-center justify-between gap-4 px-4 py-4 text-left font-medium text-slate-900';
    trigger.dataset.accordionTrigger = '';

    question.textContent = faq.question;

    icon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    icon.setAttribute('fill', 'none');
    icon.setAttribute('viewBox', '0 0 24 24');
    icon.setAttribute('stroke-width', '1.5');
    icon.setAttribute('stroke', 'currentColor');
    icon.classList.add('size-4', 'shrink-0', 'text-slate-400', 'transition-transform', 'duration-300');
    icon.dataset.accordionIcon = '';

    iconPath.setAttribute('stroke-linecap', 'round');
    iconPath.setAttribute('stroke-linejoin', 'round');
    iconPath.setAttribute('d', 'm19.5 8.25-7.5 7.5-7.5-7.5');

    panel.className = 'grid overflow-hidden transition-[grid-template-rows] duration-300 ease-out';
    panel.dataset.accordionPanel = '';

    panelInner.className = 'min-h-0 overflow-hidden';
    answer.className = 'px-4 pb-4 text-sm sm:text-base leading-relaxed text-slate-600';
    answer.textContent = faq.answer;

    icon.appendChild(iconPath);
    trigger.appendChild(question);
    trigger.appendChild(icon);
    heading.appendChild(trigger);
    panelInner.appendChild(answer);
    panel.appendChild(panelInner);
    item.appendChild(heading);
    item.appendChild(panel);

    return item;
}

function renderFaqAccordion(accordion) {
    if (accordion.children.length > 0) {
        return;
    }

    faqs.forEach((faq, index) => {
        accordion.appendChild(createAccordionItem(faq, index));
    });
}

function setAccordionItemState(item, isOpen) {
    const trigger = item.querySelector('[data-accordion-trigger]');
    const panel = item.querySelector('[data-accordion-panel]');

    if (!trigger || !panel) {
        return;
    }

    item.dataset.accordionExpanded = isOpen ? 'true' : 'false';
    trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');

    panel.classList.toggle('is-open', isOpen);
}

function initAccordion(accordion, accordionIndex) {
    renderFaqAccordion(accordion);

    const items = Array.from(accordion.querySelectorAll('[data-accordion-item]'));
    const isSingleOpen = accordion.dataset.accordionSingle === 'true';

    items.forEach((item, index) => {
        const trigger = item.querySelector('[data-accordion-trigger]');
        const panel = item.querySelector('[data-accordion-panel]');

        if (!trigger || !panel) {
            return;
        }

        const triggerId = trigger.id || `accordion-${accordionIndex + 1}-trigger-${index + 1}`;
        const panelId = panel.id || `accordion-${accordionIndex + 1}-panel-${index + 1}`;

        trigger.id = triggerId;
        panel.id = panelId;
        trigger.setAttribute('aria-controls', panelId);
        panel.setAttribute('aria-labelledby', triggerId);

        setAccordionItemState(item, item.dataset.accordionOpen === 'true');

        trigger.addEventListener('click', () => {
            const shouldOpen = item.dataset.accordionExpanded !== 'true';

            if (shouldOpen && isSingleOpen) {
                items
                    .filter((otherItem) => otherItem !== item)
                    .forEach((otherItem) => setAccordionItemState(otherItem, false));
            }

            setAccordionItemState(item, shouldOpen);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-accordion]').forEach(initAccordion);
});
