function resetPassword() {

    const data = {
        email: sessionStorage.getItem('email'),
        password: $('#password').val(),
        password_confirmation: $('#confirmPassword').val(),
    };

    $.ajax({
        url: "/api/reset-password",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            alert("Đặt lại mật khẩu thành công.")
            window.location.href="/login"
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

$(document).on('click', '#reset-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    resetPassword();
});