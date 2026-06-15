let harvestSwipers = [];

function swiperEdgeOffset(swiperElement) {
    return Number(swiperElement.getAttribute('data-swiper-edge-offset') || 32);
}

function initHarvestSwiper() {
    if (harvestSwipers.length > 0 || typeof Swiper === 'undefined') {
        return;
    }

    const swiperElements = document.querySelectorAll('.js-harvest-swiper');

    if (swiperElements.length === 0) {
        return;
    }

    swiperElements.forEach((swiperElement) => {
        if (!swiperElement.querySelector('.swiper-slide')) {
            return;
        }

        harvestSwipers.push(new Swiper(swiperElement, {
            slidesPerView: 1.2,
            spaceBetween: 14,
            slidesOffsetBefore: swiperEdgeOffset(swiperElement),
            slidesOffsetAfter: swiperEdgeOffset(swiperElement),
            centeredSlides: false,
            pagination: {
                el: swiperElement.querySelector('.swiper-pagination'),
                clickable: true,
            },
        }));
    });
}

document.addEventListener('DOMContentLoaded', initHarvestSwiper);
document.addEventListener('harvest-gallery-ready', initHarvestSwiper);
