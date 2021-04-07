$(window).ready(function () {
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
    // Related Products
    $('.related__product-slide').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 400,
        cssEase: 'ease-in-out',
        prevArrow: ".related__prev-btn-t",
        nextArrow: ".related__next-btn-t",
    })
})

// Tab controll
document.getElementById("mota-click").click();
function onpenReviewTab(e, tab) {
    const tabLinks = document.getElementsByClassName('preview__tab-btn');
    const tabContent = document.getElementsByClassName('preview__content-tab');

    for (let i = 0; i < tabLinks.length; i++){
        tabLinks[i].classList.remove('active');
    }

    for (let i = 0; i < tabContent.length; i++){
        tabContent[i].classList.remove('active');
    }

    e.target.classList.add('active');
    document.getElementById(tab).classList.add('active');
}