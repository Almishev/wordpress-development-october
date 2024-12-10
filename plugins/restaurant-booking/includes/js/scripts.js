

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.restaurant-booking-form form');
        const nameInput = form.querySelector('[name="name"]');
        const emailInput = form.querySelector('[name="email"]');
        const phoneInput = form.querySelector('[name="phone"]');
        const dateInput = form.querySelector('[name="date"]');
        const guestsInput = form.querySelector('[name="guests"]');
        const mealSelect = form.querySelector('[name="meal"]');
        const errorMessage = form.querySelector('p');

        // Патерн за имейл и телефон
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        const phonePattern = /^[0-9]{10}$/;  // Патерн за 10-цифрен български телефонен номер

        form.addEventListener('submit', function(e) {
            let valid = true;
            let errorText = '';

            // Валидация на имейл
            if (!emailPattern.test(emailInput.value)) {
                valid = false;
                errorText += 'Невалиден имейл адрес.\n';
            }

            // Валидация на телефон
            if (!phonePattern.test(phoneInput.value)) {
                valid = false;
                errorText += 'Невалиден телефонен номер. Моля, въведете 10 цифри.\n';
            }

            // Валидация на дата (не може да бъде вчера или по-стара)
            const currentDate = new Date();
            const selectedDate = new Date(dateInput.value);
            if (selectedDate < currentDate.setHours(0, 0, 0, 0)) {
                valid = false;
                errorText += 'Резервацията не може да бъде за дата от вчера или по-стара.\n';
            }

            // Валидация на брой гости
            const guests = parseInt(guestsInput.value, 10);
            if (guests < 1 || guests > 100) {
                valid = false;
                errorText += 'Броят гости трябва да бъде между 1 и 100.\n';
            }

            // Валидация на избора на ядене
            if (mealSelect.value === '') {
                valid = false;
                errorText += 'Моля, изберете обяд или вечеря.\n';
            }

            
            if (!valid) {
                e.preventDefault(); // Спира изпращането на формата
                errorMessage.textContent = errorText;
                errorMessage.style.color = 'red';
            } else {
                errorMessage.textContent = ''; // Премахваме съобщението за грешка
            }
        });
    });

