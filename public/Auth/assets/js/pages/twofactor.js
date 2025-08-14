function enable(){
    $.ajax({
        url: '/2fa/enable',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            if (res.qr_url) {
                $('#qrcode').attr('src', res.qr_url);
                $('#secret').text(res.secret);
                $('#twofaSetupModal').modal('show');
            }
        }
    });
}

function 