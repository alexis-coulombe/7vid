$('.vote').on('click', function () {

    if($(this).data('url').length) {
        let data = {
            value: $(this).data('value'),
            id: $(this).data('id')
        };
        $.ajax({
            url: $(this).data('url'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
            },
            data: data,
            type: 'POST',
            success: (result) => {
                $(this).siblings('button').removeClass('btn-danger');
                $(this).siblings('button').addClass('btn-primary');
                $(this).addClass('btn-danger');
            },
            error: (result) => {
                throw result;
            }
        });
    } else {
        window.location.href = '/login';
    }
});
