function addUser() {
    const data = {
        email: $('#email').val(),
        name: $('#name').val(),
        phone: $('#phone').val(),
        password: $('#password').val(),
        password_confirmation: $('#confirmPassword').val(),
        role: $('#role').val(),
    };

    $.ajax({
        url: "/api/add-user",
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        headers: {
            'Authorization': 'Bearer ' + sessionStorage.getItem('token')
        },
        success: function (response) {
            alert(response.message);
            $('#kt_form').trigger('reset');
        },
        error: function (xhr, status, error) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                $.each(errors, function (key, messages) {
                    $(`#${key}-error`).text(messages[0]);
                });
            }
        }
    });
}

$(document).on('click', '#addUser-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    addUser();
});