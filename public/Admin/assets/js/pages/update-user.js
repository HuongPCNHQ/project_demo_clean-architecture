function updateUser(userId) {
    const data = {
        email: $('#email').val(),
        name: $('#name').val(),
        phone: $('#phone').val(),
        role: $('#role').val(),
    };

    $.ajax({
        url: "/api/update-user/" + userId,
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(data),
        headers: {
            //'Authorization': 'Bearer ' + sessionStorage.getItem('token')
        },
        success: function (response) {
            alert(response.message);
            window.location.href = "/admin/list-user"
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

function lockAndUnlock(userId){
    $.ajax({
        url: "/api/lock-unlock/" + userId,
        type: 'PUT',
        contentType: 'application/json',
        headers: {
            //'Authorization': 'Bearer ' + sessionStorage.getItem('token')
        },
        success: function (response) {
            alert(response.message);
            window.location.href = "/admin/list-user"
        },
        error: function (xhr, status, error) {
            
        }
    });
}

$(document).ready(function () {
    if (window.location.pathname === '/admin/edit-user'){
        let userData = JSON.parse(localStorage.getItem('editUserData'));
        if (userData) {
            $("#name").val(userData.name);
            $("#phone").val(userData.phone);
            $("#email").val(userData.email);
            $("#role").val(userData.role);
            $("#updateUser-btn").attr("data-id", userData.id);
            localStorage.removeItem('editUserData');
        }
    }
});

$(document).on('click', '#updateUser-btn', function (event) {
    event.preventDefault();
    $('.error').text('');
    const userId = $(this).data('id');
    updateUser(userId);
});

$(document).on('click', '#lock-btn', function (event) {
    event.preventDefault();
    const userId = $(this).data('id');
    lockAndUnlock(userId);
});
