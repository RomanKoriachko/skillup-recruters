// Navigation

let mainButtons = document.querySelectorAll(".main-btn");
let formSection = document.querySelector(".form-section");

if (window.screen.height > 1100) {
    for (let i = 0; i < mainButtons.length; i++) {
        mainButtons[i].addEventListener("click", function () {
            window.scrollTo({
                top:
                    formSection.getBoundingClientRect().top +
                    window.pageYOffset -
                    100,
                behavior: "smooth",
            });
        });
    }
} else {
    for (let i = 0; i < mainButtons.length; i++) {
        mainButtons[i].addEventListener("click", function () {
            window.scrollTo({
                top:
                    formSection.getBoundingClientRect().top +
                    window.pageYOffset,
                behavior: "smooth",
            });
        });
    }
}

// Sliders

$(document).ready(function () {
    $(".slider-text").slick({
        arrows: false,
        infinite: true,
        dots: true,
        variableWidth: true,
        slidesToShow: 3,
        centerMode: true,
        centerPadding: "60px",
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    centerMode: false,
                },
            },
        ],
    });
});
$(document).ready(function () {
    $(".companies-slider").slick({
        arrows: false,
        infinite: true,
        centerMode: false,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 1000,
    });
});
$(document).ready(function () {
    $(".companies-tablet-slider").slick({
        arrows: false,
        infinite: true,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 1000,
    });
});

// Mobile button

const mobileBtn = document.querySelector(".mobile-registration-btn-wrapper");

window.addEventListener("scroll", () => {
    if (
        window.scrollY > window.innerHeight &&
        window.scrollY <=
            formSection.getBoundingClientRect().top +
                window.scrollY -
                window.innerHeight
    ) {
        mobileBtn.classList.add("show");
        mobileBtn.classList.remove("hide");
    } else {
        mobileBtn.classList.add("hide");
        mobileBtn.classList.remove("show");
    }
});
