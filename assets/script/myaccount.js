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

})

document.getElementById('order-tab-defalt-open').click();

// Tab
function openTab(e, tab) {

    const tabLinks = document.querySelectorAll('.order__tab-link');
    const tabContents = document.querySelectorAll('.order__content');

    const tabLinkLength = tabLinks.length;
    const tabLinkContentLength = tabContents.length;

    for (let i = 0; i < tabLinkLength; i++){
        tabLinks[i].classList.remove('order__tab-link--active');
    }
    for (let i = 0; i < tabLinkContentLength; i++) {
        tabContents[i].classList.remove('order__content--active');
    }

    e.target.classList.add("order__tab-link--active");
    document.getElementById(tab).classList.add('order__content--active');

}