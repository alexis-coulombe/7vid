let disable = false;

$(window).scroll(function () {
    if (disable === false && $('#scrolling').length) {
        if ($(window).scrollTop() + $(window).height() === $(document).height()) {
            // Exclude already fetched channels
            let data = {
                exclude: $.map($('.scrolling-result'), (n, i) => {
                    return n.id
                })
            };

            $('#loading-spinner').show();

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
                },
                error: (result) => {
                    $('#loading-spinner').hide();
                    throw result;
                }
            });
        }
    }
});
