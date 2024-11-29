jQuery(document).ready(function ($) {
    $('#email-form').on('submit', function (e) {
        e.preventDefault();

        const name = $('#name').val();
        const email = $('#email').val();
        const $submitButton = $('button[type="submit"]');
        const $responseMessage = $('#response-message');

        $submitButton.prop('disabled', true); // Disable the submit button

        $.ajax({
            url: newsletter_ajax_object.ajax_url,
            method: 'POST',
            data: {
                action: 'save_newsletter_subscription',
                name: name,
                email: email,
            },
            success: function (response) {
                if (response.success) {
                    $responseMessage.text(response.data.message).css('color', 'green');
                    $('#email-form')[0].reset();
                } else {
                    $responseMessage.text(response.data.message).css('color', 'red');
                }
                $responseMessage.show();  // Show the response message
            },
            error: function () {
                $responseMessage.text('Неуспешна връзка със сървъра.').css('color', 'red');
                $responseMessage.show();  // Show the error message
            },
            complete: function () {
                $submitButton.prop('disabled', false); // Re-enable the submit button
            },
        });

        return false; // Prevent form submission after AJAX
    });
});
