let disable = false;
let shouldCall = true;

$(window).scroll(function () {
    if (disable === false && $('#scrolling').length && shouldCall) {
        if ($(window).scrollTop() + $(window).height() >= $('footer').offset().top) {
            // Exclude already fetched channels
            let data = {
                exclude: $.map($('.scrolling-prevent'), (n, i) => {
                    return n.id
                }),
                type: $('#scrolling').data('type'),
                video_id: $('#scrolling').data('video-id') ? $('#scrolling').data('video-id') : null,
            };

            $('#loading-spinner').show();
            shouldCall = false;

            $.ajax({
                url: $('#scrolling').data('url'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
                },
                data: data,
                type: 'POST',
                success: (result) => {
                    $('#loading-spinner').hide();
                    if (result === 'Done') {
                        disable = true;
                        return;
                    }

                    $('#scrolling').append(result);
                    shouldCall = true;
                },
                error: (result) => {
                    $('#loading-spinner').hide();
                    throw result;
                }
            });
        }
    }
});
