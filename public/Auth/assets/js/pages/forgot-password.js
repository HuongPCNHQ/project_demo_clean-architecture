function forgotPassword() {

    const data = {
        email: $('#email').val(),
    };

    $.ajax({
        url: "/api/forgot-password",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            window.location.href="/reset-password"
            sessionStorage.setItem('email', email.value);
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                console.log(xhr.responseJSON);
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            }
            console.log(xhr.responseText);
        }
    });
}

$(document).on('click', '#forgot-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    forgotPassword();
});