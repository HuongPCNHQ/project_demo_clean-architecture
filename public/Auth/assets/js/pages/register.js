function register() {

    const data = {
        name: $('#name').val(),
        phone: $('#phone').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        password_confirmation: $('#confirmPassword').val(),
    };

    $.ajax({
        url: "/api/register",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            window.location.href="/verify-otp";
            sessionStorage.setItem('email', email.value);
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    if (key === "password" && messages[0].includes("Mật khẩu xác nhận không khớp")) {
                        $("#password_confirmation-error").text(messages[0]);
                    } else {
                        $(`#${key}-error`).text(messages[0]);
                    }
                });
            }
        }
    });
}

$(document).on('click', '#register-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    register();
});