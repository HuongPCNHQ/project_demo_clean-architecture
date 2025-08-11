function active() {

    const data = {
        email: sessionStorage.getItem('email'),
        otp_code: $('#otp').val(),
    };

    $.ajax({
        url: "/api/active",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            alert("Xác thực tài khoản thành công");
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

$(document).on('click', '#confirm-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    active();
});