//* Toggle search */
window.addEventListener('DOMContentLoaded', function () {

    // Scrolltop
    $(".scroll-top-btn").on('click', function (event) {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    // Toogle 
    $('.right__search i').click(function () {
        document.querySelector(".right__search-wrapper form").classList.toggle("search--active");
    })
    $('.right__menu i').click(function () {
        document.querySelector(".right__menu-wrapper").classList.toggle("right__menu-wrapper--active");
    })
    $('.right__cart i.fa.fa-shopping-bag').click(function () {
        document.querySelector(".right__cart-wrapper").classList.toggle("right__cart-wrapper--active");
    })
    $('.right__cart-number').click(function () {
        document.querySelector(".right__cart-wrapper").classList.toggle("right__cart-wrapper--active");
    })

    // Header stiky
    $(window).scroll(function () {
        if (window.pageYOffset > 150) {
            document.querySelector(".header").classList.add("header--sticky");
        } else {
            document.querySelector(".header").classList.remove("header--sticky");
        }
        if (document.querySelector(".scroll-top-btn")) {
            if (window.pageYOffset > 550) {
                document.querySelector(".scroll-top-btn").classList.add("active");
            } else {
                document.querySelector(".scroll-top-btn").classList.remove("active");
            }
        }
    })

    // Slide slick
    $('.slide').slick({
        dots: true,
        infinite: true,
        speed: 1500,
        fade: true,
        cssEase: 'linear',
        prevArrow: ".slides__prev-btn",
        nextArrow: ".slides__next-btn",
        autoplay: true,
        autoplaySpeed: 10000,

    });
    // Gsap
    gsap.fromTo(".slide__item .slide__item-content--1 h2", {
        opacity: 0,
        y: 30,
        ease: "power2.out"
    }, {
        opacity: 1,
        y: 0,
        duration: 1,
        ease: "power2.out"
    })
    gsap.fromTo(".slide__item .slide__item-content--1 h1", {
        opacity: 0,
        y: 30,
    }, {
        opacity: 1,
        y: 0,
        duration: 1,
        delay: .3,
        ease: "power2.out"
    })
    gsap.fromTo(".slide__item .slide__item-content--1 p", {
        opacity: 0,
        y: 30,
    }, {
        opacity: 1,
        y: 0,
        duration: 1,
        delay: .5,
        ease: "power2.out"
    })
    gsap.fromTo(".slide__item .slide__item-content--1 a", {
        opacity: 0,
        y: 30,
    }, {
        opacity: 1,
        y: 0,
        duration: .5,
        delay: .9,
        ease: "power2.out"
    })
    // content 2
    gsap.to(".slide__item .slide__item-content--2 h2", {
        opacity: 0,
        y: 30,
        ease: "power2.out"
    })
    gsap.to(".slide__item .slide__item-content--2 h1", {
        opacity: 0,
        y: 30,
    })
    gsap.to(".slide__item .slide__item-content--2 p", {
        opacity: 0,
        y: 30,
    })
    gsap.to(".slide__item .slide__item-content--2 a", {
        opacity: 0,
        y: 30,
    })
    $('.slide').on("afterChange", (function (slick, currentSlide) {
        if (currentSlide.currentSlide === 0) {
            gsap.fromTo(".slide__item .slide__item-content--1 h2", {
                opacity: 0,
                y: 20,
                ease: "power2.out"
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out"
            })
            gsap.fromTo(".slide__item .slide__item-content--1 h1", {
                opacity: 0,
                y: 20,
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: .3,
                ease: "power2.out"

            })
            gsap.fromTo(".slide__item .slide__item-content--1 p", {
                opacity: 0,
                y: 20,
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: .7,
                ease: "power2.out"
            })
            gsap.fromTo(".slide__item .slide__item-content--1 a", {
                opacity: 0,
                y: 20,
            }, {
                opacity: 1,
                y: 0,
                duration: .4,
                delay: .9,
                ease: "power.out"
            })
        } else {
            gsap.to(".slide__item .slide__item-content--1 h2", {
                opacity: 0,
            })
            gsap.to(".slide__item .slide__item-content--1 h1", {
                opacity: 0,

            })
            gsap.to(".slide__item .slide__item-content--1 p", {
                opacity: 0,
            })
            gsap.to(".slide__item .slide__item-content--1 a", {
                opacity: 0,
            })
        }
        if (currentSlide.currentSlide === 1) {
            gsap.fromTo(".slide__item .slide__item-content--2 h2", {
                opacity: 0,
                y: 20,
                ease: "power2.out"
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out"
            })
            gsap.fromTo(".slide__item .slide__item-content--2 h1", {
                opacity: 0,
                y: 20,
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: .3,
                ease: "power2.out"

            })
            gsap.fromTo(".slide__item .slide__item-content--2 p", {
                opacity: 0,
                y: 20,
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: .7,
                ease: "power2.out"
            })
            gsap.fromTo(".slide__item .slide__item-content--2 a", {
                opacity: 0,
                y: 20,
            }, {
                opacity: 1,
                y: 0,
                duration: .4,
                delay: .9,
                ease: "power.out"
            })
        } else {
            gsap.to(".slide__item .slide__item-content--2 h2", {
                opacity: 0,
            })
            gsap.to(".slide__item .slide__item-content--2 h1", {
                opacity: 0,

            })
            gsap.to(".slide__item .slide__item-content--2 p", {
                opacity: 0,
            })
            gsap.to(".slide__item .slide__item-content--2 a", {
                opacity: 0,
            })
        }

    }))

    // Food category
    $(".slide-wrapper__slide").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 1500,
    });

    // Feature
    $('.newarrivals__wrapper-slide').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 6700,
        speed: 800,
        cssEase: 'ease-in-out',
        prevArrow: ".feature__new-arrivals-prev-btn",
        nextArrow: ".feature__new-arrivals-next-btn",
    })

    $('.bestseller__wrapper-slide').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 12700,
        speed: 800,
        cssEase: 'ease-in-out',
        prevArrow: ".feature__bestseller-prev-btn",
        nextArrow: ".feature__bestseller-next-btn",
    })

    $('.mostviewer__wrapper-slide').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 9900,
        speed: 800,
        cssEase: 'ease-in-out',
        prevArrow: ".feature__mostviewer-prev-btn",
        nextArrow: ".feature__mostviewer-next-btn",
    })

    // Testimonial
    $('.testimonial__slide-text').slick({
        slidesToScroll: 1,
        slidesToShow: 1,
        speed: 400,
        cssEase: 'ease-in-out',
        prevArrow: ".testimonial-prev-btn",
        nextArrow: ".testimonial-next-btn",
    })

    // Our Blog
    $('.blog__slide').slick({
        slidesToScroll: 1,
        slidesToShow: 3,
        speed: 600,
        cssEase: 'ease-in-out',
        prevArrow: ".blog-prev-btn",
        nextArrow: ".blog-next-btn",
    })
})

// Products tabs
document.getElementById("traicay").click();

function openTab(e, category) {
    var i, tabContents, tabLinks;
    tabLinks = $('.products__tab-link');
    tabContents = $('.slide-wrapper');

    for (i = 0; i < tabContents.length; i++) {
        tabContents[i].classList.remove("active")

    }
    for (i = 0; i < tabLinks.length; i++) {
        tabLinks[i].classList.remove("products__tab-link--active");
    }
    e.target.classList.add("products__tab-link--active");

    document.getElementById(category).classList.add("active")

}

// Product content
$('.content__slide.content__slide-traicay').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 400,
    cssEase: 'ease-in-out',
    prevArrow: ".content__prev-btn-t",
    nextArrow: ".content__next-btn-t",
})
$('.content__slide.content__slide-rau').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 400,
    cssEase: 'ease-in-out',
    prevArrow: ".content__prev-btn-rau",
    nextArrow: ".content__next-btn-rau",
})
$('.content__slide.content__slide-nuocep').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 400,
    cssEase: 'ease-in-out',
    prevArrow: ".content__prev-btn-nuocep",
    nextArrow: ".content__next-btn-nuocep",
})
$('.content__slide.content__slide-tra').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 400,
    cssEase: 'ease-in-out',
    prevArrow: ".content__prev-btn-tra",
    nextArrow: ".content__next-btn-tra",
})
