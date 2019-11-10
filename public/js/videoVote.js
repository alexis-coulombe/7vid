$('.vote').on('click', function () {

    let data = {
        value: $(this).data('value'),
        videoId: $(this).data('video-id')
    };
    $.ajax({
        url: $('#vote').data('url'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
        },
        data: data,
        type: 'POST',
        success: (result) => {

        },
        error: (result) => {
            throw result;
        }
    });
});
