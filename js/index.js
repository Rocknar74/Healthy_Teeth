/*  NAVIFATION PANEL
=================================================================*/
const NAV_HEADER = document.querySelector('.nav_bar');

window.addEventListener('scroll', () => { // при проматывании страници, обработчик добавляет класс, с прилигающими к нему стилями, к секции навигации. 
    if (pageYOffset > 100) {
        NAV_HEADER.id = 'window-scroll';
    } else {
        NAV_HEADER.id = '';
    }
})



/* REVIEW WINDOW 
==========================================================================*/
const ADD_TABLE = document.querySelector('.add_table');
const OVERLAY_ADD_TABLE = document.querySelector('.overlay');
const ADD_BUTTON = document.querySelector('.add_button');
const ESC_BUTTON = document.querySelector('.esc_button');

ADD_BUTTON.addEventListener('click', () => { // обработчик делает видимым секцию с формой для отзыва
    ADD_TABLE.classList.add('add_table-active');
})
OVERLAY_ADD_TABLE.addEventListener('click', () => {
    ADD_TABLE.classList.remove('add_table-active');
})
ESC_BUTTON.addEventListener('click', () => { // обработчик скрывает секцию с формой для отзыва
    ADD_TABLE.classList.remove('add_table-active');
})



// NEWS SLIDER LOGIC 
//======================================================
const CONTAINER_NEWS = document.querySelectorAll('.container_news');
const ARRAY_NEWS = Array.from(CONTAINER_NEWS);
var index_news = 0;

function move_news() {
    ARRAY_NEWS[index_news].classList.remove('active-news');
    if (index_news++ == ARRAY_NEWS.length - 1) { index_news = 0 };
    ARRAY_NEWS[index_news].classList.add('active-news'); 
}

window.onload = setInterval(() => move_news(), 7000);



// PERSONNEL SLIDER LOGIC 
//======================================================
const SLIDER_BUTTONS = document.querySelectorAll('.personnel_slider_buttons');
const CONTAINER_PERSONNEL = document.querySelector('.container_personnel_slides');
const PERSONNEL_MAIN = document.querySelector('.main_personnel_slides');
const PERSONNEL_LENGTH = document.querySelectorAll('.personnel').length;
const WIDTH_PERSONNEL = Math.ceil(PERSONNEL_LENGTH / 3) * 100;
const LAST_CHILD = PERSONNEL_LENGTH - 3;

var count_personnel = 0;
var timerId = setTimeout(() => move_direction_slides("right"), 5000);

PERSONNEL_MAIN.previousElementSibling.innerHTML += `<style type="text/css">
.main_personnel_slides {width: ${WIDTH_PERSONNEL}%;}
.personnel {width: ${((CONTAINER_PERSONNEL.offsetWidth / 3) - 20)}px;}
</style>`;

SLIDER_BUTTONS.forEach(item => { // кнопки ручного переключения слайдов
    item.addEventListener("click", () => {
        clearTimeout(timerId);
        move_direction_slides(`${item.value}`);
    });
});

function move_direction_slides(move_direction) { //выбор направления переключения слайдов
    switch(move_direction) {
        case("right"):
            count_personnel++;
            break;
        case("left"):
            count_personnel--;
            break;
    };

    if (count_personnel < 0) { count_personnel = LAST_CHILD;} //проверка на минимум слайдов
    if (count_personnel > LAST_CHILD) { count_personnel = 0;} //проверка на максимум слайдов
    PERSONNEL_MAIN.style = `margin-left: -${count_personnel * 33.3333}%`//сдвиг окна слайдеров

    timerId = setTimeout(() => move_direction_slides("right"), 5000);
};
// function auto_switch_slides(move_direction) { // засцикливание авто преключение слайдов
//     timerId = setTimeout(() => move_direction_slides(move_direction), 5000);
// }
