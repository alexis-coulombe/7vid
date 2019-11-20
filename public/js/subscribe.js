$('.subscribe').on('click', function () {

    if($(this).data('url').length) {
        let data = {
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
                $('.subscribe-text').text(result);
            },
            error: (result) => {
                throw result;
            }
        });
    } else {
        window.location.href = '/login';
    }
});
