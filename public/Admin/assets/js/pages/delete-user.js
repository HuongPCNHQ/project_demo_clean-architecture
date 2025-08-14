function removeUser(userId){
    $.ajax({
        url: "/api/delete-user/" + userId,
        type: 'delete',
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

$(document).on('click', '#delete-user', function (event) {
    event.preventDefault();
    const userId = $(this).data('id');
    removeUser(userId);
});