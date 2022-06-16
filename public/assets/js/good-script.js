function slickslider(){
    $('.sliding-flex-box-slider').slick({
        infinite: false,
        dots: false,
        centerMode: false,
        adaptiveHeight: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: "unslick"
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2.3,
                    slideToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1.8,
                    slideToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1.2,
                    slideToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slideToScroll: 1,
                }
            }
        ]
    });
}