jQuery(document).ready(function($) {
    $('#reservation-form').on('submit', function(e) {
        e.preventDefault();

        const name = $('#name').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        const date = $('#date').val();
        const meal = $('#meal').val();  
        const arrival_time = $('#arrival_time').val(); 
        const $responseMessage = $('#reservation-response-message');
        const nonce = $('#reservation_nonce_field').val();  

        $.ajax({
            url: ajaxurl,
            method: 'POST',
            data: {
                action: 'save_reservation',
                name: name,
                email: email,
                phone: phone,
                date: date,
                meal: meal,  
                arrival_time: arrival_time,  
                reservation_nonce_field: nonce 
            },
            success: function(response) {
                if (response.success) {
                    $responseMessage.text(response.data.message).css('color', 'green');
                } else {
                    $responseMessage.text(response.data.message).css('color', 'red');
                }
                $responseMessage.show();
            },
            error: function() {
                $responseMessage.text('Грешка при обработката на заявката.').css('color', 'red');
                $responseMessage.show();
            }
        });
    });
});
