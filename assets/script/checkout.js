$(window).ready(function () {
    
    $(".scroll-top-btn").on('click', function (event) {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

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
