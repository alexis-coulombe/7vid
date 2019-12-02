$('.subscribe').on('click', function () {

    if ($(this).data('url').length) {
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
                $(this).closest(this).find('.subscribe-text').text(result);
                let subCount = $(this).closest(this).find('.subscriber-count');

                if (result === 'Unsubscribe') {
                    subCount.text(parseInt(subCount.text()) + 1);
                } else {
                    subCount.text(parseInt(subCount.text()) - 1);
                }
            },
            error: (result) => {
                throw result;
            }
        });
    } else {
        window.location.href = '/login';
    }
});
