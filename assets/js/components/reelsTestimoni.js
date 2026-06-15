const reelsTestimoniLinks = [
    'https://www.instagram.com/reel/DW3hcuLjzee/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==',
    'https://www.instagram.com/reel/DMNVyKHSXNI/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==',
    'https://www.instagram.com/reel/DTh-v83k4f1/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==',
    'https://www.instagram.com/reel/DOP59qNk50k/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==',
    'https://www.instagram.com/reel/DOvANcaE_Qg/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=='
];

function instagramEmbedUrl(link) {
    try {
        const url = new URL(link);
        const paths = url.pathname.split('/').filter(Boolean);
        const type = paths[0];
        const shortcode = paths[1];

        if (!['p', 'reel', 'tv'].includes(type) || !shortcode) {
            return '';
        }

        return `https://www.instagram.com/${type}/${shortcode}/embed`;
    } catch (error) {
        return '';
    }
}

function createReelsTestimoniSlide(link) {
    const embedUrl = instagramEmbedUrl(link);
    const slide = document.createElement('div');
    const article = document.createElement('article');
    const frame = document.createElement('div');
    const loader = document.createElement('div');
    const iframe = document.createElement('iframe');

    slide.className = 'swiper-slide';
    article.className = 'overflow-hidden rounded-xl border border-slate-200 bg-white';
    frame.className = 'reels-testimoni-frame';
    loader.className = 'reels-testimoni-loader';
    iframe.className = 'reels-testimoni-embed';
    iframe.dataset.src = embedUrl;
    iframe.title = 'Video testimoni Instagram';
    iframe.loading = 'lazy';
    iframe.allow = 'autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share';
    iframe.allowFullscreen = true;
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('scrolling', 'no');
    iframe.addEventListener('load', () => loader.remove(), { once: true });

    frame.appendChild(loader);
    frame.appendChild(iframe);
    article.appendChild(frame);
    slide.appendChild(article);

    return slide;
}

function loadReelsTestimoniEmbeds(swiperElement) {
    swiperElement.querySelectorAll('iframe[data-src]').forEach((iframe) => {
        iframe.src = iframe.dataset.src;
        iframe.removeAttribute('data-src');
    });
}

function observeReelsTestimoni(swiperElement) {
    if (!('IntersectionObserver' in window)) {
        window.addEventListener('load', () => loadReelsTestimoniEmbeds(swiperElement), { once: true });
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        if (!entries.some((entry) => entry.isIntersecting)) {
            return;
        }

        loadReelsTestimoniEmbeds(swiperElement);
        observer.disconnect();
    }, {
        rootMargin: '360px 0px',
        threshold: 0,
    });

    observer.observe(swiperElement);
}

function createReelsTestimoniNavigation() {
    const controls = document.createElement('div');
    const prevButton = document.createElement('button');
    const nextButton = document.createElement('button');

    controls.className = 'reels-testimoni-controls';
    prevButton.className = 'reels-testimoni-nav-button';
    nextButton.className = 'reels-testimoni-nav-button';
    prevButton.type = 'button';
    nextButton.type = 'button';
    prevButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" /></svg>';
    nextButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /></svg>';
    prevButton.setAttribute('aria-label', 'Geser testimoni sebelumnya');
    nextButton.setAttribute('aria-label', 'Geser testimoni berikutnya');

    controls.appendChild(prevButton);
    controls.appendChild(nextButton);

    return {
        controls,
        prevButton,
        nextButton,
    };
}

function initReelsTestimoni() {
    const swiperElement = document.querySelector('.js-reels-testimoni-swiper');

    if (!swiperElement || typeof Swiper === 'undefined') {
        return;
    }

    const validLinks = reelsTestimoniLinks.filter((link) => instagramEmbedUrl(link) !== '');

    if (validLinks.length === 0) {
        swiperElement.closest('section')?.remove();
        return;
    }

    const wrapper = document.createElement('div');
    const navigation = createReelsTestimoniNavigation();

    wrapper.className = 'swiper-wrapper';

    validLinks.forEach((link) => wrapper.appendChild(createReelsTestimoniSlide(link)));

    swiperElement.innerHTML = '';
    swiperElement.appendChild(wrapper);
    if (validLinks.length > 1) {
        swiperElement.appendChild(navigation.controls);
    }

    const swiperOptions = {
        slidesPerView: 1.08,
        spaceBetween: 14,
        slidesOffsetBefore: 32,
        slidesOffsetAfter: 32,
        centeredSlides: false,
    };

    if (validLinks.length > 1) {
        swiperOptions.navigation = {
            prevEl: navigation.prevButton,
            nextEl: navigation.nextButton,
        };
    }

    new Swiper(swiperElement, swiperOptions);

    observeReelsTestimoni(swiperElement);
}

document.addEventListener('DOMContentLoaded', initReelsTestimoni);
