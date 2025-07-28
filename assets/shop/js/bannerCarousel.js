import 'slick-carousel';

$('.js-banners-carousel').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: $('.js-banners-nav-left'),
    nextArrow: $('.js-banners-nav-right'),
    appendArrows: false
});

