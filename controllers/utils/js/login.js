$(document).ready(function () {
    let error = $('#error');
    $('#password').on('keyup', function () {
        pin = $(this).val();


        if (pin.length == 7) {
            $.ajax({
                url: 'controllers/login/',
                type: 'POST',
                data: {
                    pin: pin
                },
                success: function (data) {
                    console.log(data);
                    contieneSuccess = data.indexOf('success');
                    if (contieneSuccess != -1) {
                        window.location.href = 'app/home/';
                    } else {
                        error.html(data);
                    }
                }
            });
        }
    });

    $('.btn--primary').on('click', function (e) {
        e.preventDefault();
        let pin = $('#password').val();
        $.ajax({
            url: 'controllers/login/',
            type: 'POST',
            data: {
                pin: pin
            },
            success: function (data) {
                console.log(data);
                contieneSuccess = data.indexOf('success');
                if (contieneSuccess != -1) {
                    window.location.href = 'app/home/';
                } else {
                    error.html(data);
                }
            }
        });
    });


});