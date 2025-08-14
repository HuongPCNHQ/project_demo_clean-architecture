function showInfor() {

    const data = {
        email: $('#email').val(),
        password: $('#password').val(),
    };
    const userId = sessionStorage.getItem('id');

    $.ajax({
        url: "/api/show-infor/" + userId,
        type: 'GET',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            $users = response.data.user;
            $('#name').val($users.name);
            $('#phone').val($users.phone);
            $('#email').val($users.email);
            $('#role').text($users.role.charAt(0).toUpperCase() + $users.role.slice(1));
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function updateInfor() {

    const data = {
        name: $('#name').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
    };
    const userId = sessionStorage.getItem('id');

    $.ajax({
        url: "/api/update-infor/" + userId,
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (response) {
            alert(response.message);
            location.reload();
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

$(document).on('click', '#update-infor-btn', function (event) {
    event.preventDefault();
    updateInfor();
});

$(document).ready(function () {
    if (window.location.pathname === '/information')
        showInfor(); // Gọi hàm của bạn khi trang load 
    if (window.location.pathname === '/admin/information')
        showInfor(); // Gọi hàm của bạn khi trang load 
});