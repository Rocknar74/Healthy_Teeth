
const BOTTOM_HEADER = document.querySelector('.nav_header');

window.addEventListener('scroll', () => { // обработчик добавляет класс, с рпилигающими к нему стилями, секции навигации при проматывании страници
    if (pageYOffset > 105) {
        BOTTOM_HEADER.classList.add("window-scroll");
    } else {
        BOTTOM_HEADER.classList.remove("window-scroll");
    }
})

const OVERLAY_REWIEW = document.querySelector('.overlay_review');
const REWIEW_BUTTON = document.querySelector('.review_button');
const ESC_BUTTON = document.querySelector('.esc_button');

REWIEW_BUTTON.addEventListener('click', () => { // обработчик делает видимым секцию с формой для отзыва
    OVERLAY_REWIEW.classList.add('overlay_review-active');
})
ESC_BUTTON.addEventListener('click', () => {// обработчик скрывает секцию с формой для отзыва
    OVERLAY_REWIEW.classList.remove('overlay_review-active');
})