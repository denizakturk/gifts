$(document).ready(function () {
    $('#gift-send-button').on('click', function () {

        $.ajax({
            type: 'POST',
            url: '/gift/send',
            data: $('#gift-form').serialize(),
            beforeSend: function () {
                // setting a timeout
                $('#gift-send-button').addClass('disabled');
                $('#gift-send-button').attr('disabled', 'disabled');
            },
            success: function (data) {
                var response = JSON.parse(data)

                if (response.status) {
                    alert('Your gift has been successfully sent.')
                } else {
                    alert('Could not send gift!');
                }

                $('#gift-send-button').removeClass('disabled');
                $('#gift-send-button').removeAttr('disabled');
            },
            error: function (xhr) {
                $('#gift-send-button').removeClass('disabled');
                $('#gift-send-button').removeAttr('disabled');
                alert('Could not send gift!');
            },
            complete: function () {
                $('#gift-send-button').removeClass('disabled');
                $('#gift-send-button').removeAttr('disabled');
            },
            dataType: 'html'
        });
    });

    $('.approve').on('click', function () {
        var approve_id = $(this).data('approve-id');
        var approved = $(this).data('approved');
        $.ajax({
            type: 'POST',
            url: '/member/gift/approved',
            data: {"approve_id": approve_id, "approved": approved},
            beforeSend: function () {
                $('button.approve').addClass('disabled');
                $('button.approve').attr('disabled', 'disabled');
            },
            success: function (data) {
                var response = JSON.parse(data)

                if (response.status) {
                    alert('Successful');
                    $('#gift-'+approve_id).remove();
                } else {
                    alert('Error!');
                }
                $('button.approve').removeClass('disabled');
                $('button.approve').removeAttr('disabled', 'disabled');
            },
            error: function (xhr) {
                $('button.approve').removeClass('disabled');
                $('button.approve').removeAttr('disabled', 'disabled');
                alert('Error!');
            },
            complete: function () {
                $('button.approve').removeClass('disabled');
                $('button.approve').removeAttr('disabled', 'disabled');
            },
            dataType: 'html'
        });
    });

});