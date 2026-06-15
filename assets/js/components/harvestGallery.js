function formatType(value) {
    return value
        .replace(/[-_]+/g, ' ')
        .replace(/\b\w/g, (letter) => letter.toUpperCase());
}

function canLoadImage(src) {
    return new Promise((resolve) => {
        const image = new Image();

        image.onload = () => resolve(true);
        image.onerror = () => resolve(false);
        image.src = src;
    });
}

const harvestTypes = ['Jasmine', 'Hollyhock', 'Iris'];

async function collectHarvestImages(basePath, folder) {
    const extensions = ['webp', 'jpg', 'jpeg', 'png'];
    const maxImagesPerFolder = 20;
    const images = [];

    for (let index = 1; index <= maxImagesPerFolder; index += 1) {
        let found = false;

        for (const extension of extensions) {
            const src = `${basePath}/${encodeURIComponent(folder)}/${index}.${extension}`;

            if (await canLoadImage(src)) {
                images.push({
                    type: folder,
                    src,
                    alt: `${formatType(folder)} ${index}`,
                });
                found = true;
                break;
            }
        }

        if (!found) {
            break;
        }
    }

    return images;
}

function createHarvestSlide(image) {
    const slide = document.createElement('div');
    const article = document.createElement('article');
    const frame = document.createElement('div');
    const img = document.createElement('img');

    slide.className = 'swiper-slide';
    article.className = 'overflow-hidden rounded-xl border border-slate-200 bg-white';
    frame.className = 'harvest-gallery-frame';
    img.className = 'harvest-gallery-image';
    img.src = image.src;
    img.alt = image.alt;
    img.loading = 'lazy';
    img.decoding = 'async';

    frame.appendChild(img);
    article.appendChild(frame);
    slide.appendChild(article);

    return slide;
}

function renderHarvestSection(wrapper, type, images) {
    const section = document.createElement('section');
    const header = document.createElement('div');
    const title = document.createElement('h3');
    const swiper = document.createElement('div');
    const swiperWrapper = document.createElement('div');
    const pagination = document.createElement('div');

    section.className = 'flex flex-col gap-3';
    header.className = 'px-8';
    title.className = 'text-base font-semibold tracking-tight text-slate-900';
    title.textContent = formatType(type);
    swiper.className = 'swiper js-harvest-swiper tasri-swiper';
    swiperWrapper.className = 'swiper-wrapper';
    pagination.className = 'swiper-pagination';

    images.forEach((image) => swiperWrapper.appendChild(createHarvestSlide(image)));

    header.appendChild(title);
    swiper.appendChild(swiperWrapper);
    section.appendChild(swiper);
    wrapper.appendChild(section);
}

document.addEventListener('DOMContentLoaded', async () => {
    const gallery = document.getElementById('gallery');

    if (!gallery) {
        return;
    }

    const basePath = gallery.dataset.galleryBase || '/assets/images/harvest';
    const wrapper = gallery.querySelector('[data-gallery-wrapper]');

    if (!wrapper) {
        return;
    }

    wrapper.innerHTML = '';

    for (const type of harvestTypes) {
        const images = await collectHarvestImages(basePath, type);

        if (images.length > 0) {
            renderHarvestSection(wrapper, type, images);
        }
    }

    document.dispatchEvent(new CustomEvent('harvest-gallery-ready'));
});
