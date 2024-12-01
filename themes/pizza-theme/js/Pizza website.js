// Sticky header при скрол
const header = document.querySelector("header");
window.addEventListener("scroll", function () {
    header.classList.toggle("sticky", window.scrollY > 0);
});

// Меню и navbar логика
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
};

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('open');
};

// ScrollReveal анимации
const sr = ScrollReveal({
    distance: '30px',
    duration: 2500,
    reset: true
});
sr.reveal('.home-text', { delay: 200, origin: 'left' });
sr.reveal('.home-img', { delay: 200, origin: 'right' });
sr.reveal('.container, .about, .menu, .contact', { delay: 200, origin: 'bottom' });

// jQuery логика за AJAX заявка
/*
jQuery(document).ready(function ($) {
    $('#email-form').on('submit', function (e) {
        e.preventDefault(); // Предотвратяване на презареждането на страницата

        var name = $('#name').val(); // Вземане на стойност от полето за име
        var email = $('#email').val(); // Вземане на стойност от полето за имейл
        

        // Проверка дали полетата са попълнени
        if (!name || !email) {
            alert('Моля, попълнете всички полета.');
            return;
        }

        console.log('Изпращам:', name, email); // Тук логваме данните

        $.ajax({
            url: pizza_ajax_object.ajax_url, 
            type: 'POST', 
            data: {
                action: 'save_newsletter_subscription',
                name: name,
                email: email
            },
           
            success: function (response) {
                console.log('Отговор:', response);
                if (response.success) {
                    $('#response-message').html('<p>' + response.data.message + '</p>'); 
                } else {
                    $('#response-message').html('<p>' + response.data.message + '</p>'); 
                }
            },
            error: function () {
                $('#response-message').html('<p>Възникна грешка. Опитайте отново.</p>');

            }
        });
    });
});
*/
