
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