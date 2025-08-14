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
            alert(response.message);
            if(response.data.user.role === "user"){
                window.location.href="/home"
            } else{
                window.location.href="/admin/dashboard"
            }
            sessionStorage.setItem('email', email.value);
            sessionStorage.setItem('id', response.data.user.id);
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            }
            if (xhr.status === 400) {
                
                alert(xhr.responseJSON.message);
            }
        }
    });
}

$(document).on('click', '#login-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    login();
});