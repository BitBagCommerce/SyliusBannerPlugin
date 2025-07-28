import Swiper from 'swiper';
import { Navigation, Autoplay } from 'swiper/modules';

import 'swiper/css';

const bannersCarousels = document.querySelectorAll('.banners-carousel')

for (let i= 0; i < bannersCarousels.length; i++ ) {

    bannersCarousels[i].classList.add(`banners-carousel-${i}`);

    const swiper = new Swiper(`.banners-carousel-${i}`, {
        autoplay: {
            delay: 5000,
        },
        loop: true,
        modules: [Navigation, Autoplay],
        navigation: {
            nextEl: `.banners-carousel-${i} .swiper-button-next`,
            prevEl: `.banners-carousel-${i} .swiper-button-prev`,
        },
        observeParents: true,
        observer: true,
        slidesPerView: 1,
        spaceBetween: 32,
        speed: 400,
    });
}
