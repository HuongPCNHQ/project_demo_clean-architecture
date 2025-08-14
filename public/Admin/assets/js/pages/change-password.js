function changePassword(){
    const data = {
        current_password: $('#current_password_admin').val(),
        new_password: $('#new_password_admin').val(),
        new_password_confirmation: $('#new_password_confirmation_admin').val(),
    };
    const userId = sessionStorage.getItem('id');
    $.ajax({
        url: "/api/change-password/" + userId,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        headers: {
            'Authorization': 'Bearer ' + sessionStorage.getItem('token')
        },
        success: function (response) {
            alert(response.message);
            window.location.href = "/admin/dashboard"
            
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                console.log(errors);
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

$(document).on('click', '#change-password-btn-admin', function (event) {
    event.preventDefault();
    $('.error').text('');
    changePassword();
});