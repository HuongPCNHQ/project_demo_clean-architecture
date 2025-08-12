function login() {

    const data = {
        email: $('#email').val(),
        password: $('#password').val(),
    };

    $.ajax({
        url: "/api/login",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            alert("Đăng nhập thành công")
            window.location.href="/home"
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

$(document).on('click', '#login-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    login();
});