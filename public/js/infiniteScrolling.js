let disable = false;
let shouldCall = true;

$(window).scroll(function () {
    if (disable === false && $('#scrolling').length && shouldCall) {
        let scrollingElement = $('#scrolling');
        let loadingSpinner = $('#loading-spinner');

        if ($(window).scrollTop() + $(window).height() >= $('footer').offset().top) {
            let data = {
                // Exclude already fetched channels
                exclude: $.map($('.scrolling-prevent'), (n) => {
                    return n.id
                }),
                //
                type: scrollingElement.data('type'),
                video_id: scrollingElement.data('video-id') ? scrollingElement.data('video-id') : null,
                category_id: scrollingElement.data('category-id') ? scrollingElement.data('category-id') : null,
            };

            loadingSpinner.show();
            shouldCall = false;

            $.ajax({
                url: scrollingElement.data('url'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
                },
                data: data,
                type: 'POST',
                success: (result) => {
                    loadingSpinner.hide();
                    if (result === 'Done') {
                        disable = true;
                        return;
                    }

                    scrollingElement.append(result);
                    onVoteClickEvent();
                    shouldCall = true;
                },
                error: (result) => {
                    loadingSpinner.hide();
                    throw result;
                }
            });
        }
    }
});
