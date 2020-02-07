jQuery(function ($) {
    let popup_width = 400;
    let spinner = '<div id="floatingCirclesG">' +
        '<div class="f_circleG" id="frotateG_01"></div>' +
        '<div class="f_circleG" id="frotateG_02"></div>' +
        '<div class="f_circleG" id="frotateG_03"></div>' +
        '<div class="f_circleG" id="frotateG_04"></div>' +
        '<div class="f_circleG" id="frotateG_05"></div>' +
        '<div class="f_circleG" id="frotateG_06"></div>' +
        '<div class="f_circleG" id="frotateG_07"></div>' +
        '<div class="f_circleG" id="frotateG_08"></div>' +
        '</div>';

    let getPopupWidth = function () {
        return Math.min(popup_width, $(window).width());
    };

    $(".bop-ref").mouseenter(function () {
        let $popup = $('<div class="bop-popup"></div>')

        let $popup_loading = $('<div class="bop-popup-loading">' + spinner + '</div>');
        $popup.append($popup_loading);

        // Calculate position

        let left = $(this).offset().left;
        let out_of_bounds = $(window).width() - (left + getPopupWidth());

        if (out_of_bounds < 0) {
            left += out_of_bounds;
        }

        $popup.css({
            top: $(this).offset().top + $(this).height() + 8,
            left: left,
            width: getPopupWidth()
        });

        // Fetch API

        let query_trans = encodeURIComponent($(this).data("trans"));
        let query_q = encodeURIComponent($(this).data("query"));

        fetch('https://api.bibleonline.ru/bible?trans=' + query_trans + '&q=' + query_q)
            .then((response) => {
                return response.text();
            })
            .then((text) => {
                let json = eval(text);

                if (json.length < 1 || !json[0].hasOwnProperty("h2")) {
                    return;
                }

                let title = json[0].h2;
                let href = "https://bibleonline.ru/search/?s=" + encodeURIComponent(json[0].h2);

                let $popup_title = $('<div class="bop-popup-title">' +
                    '<a href="' + href + '" target="_blank">' + title + '</a></div>');
                let $popup_content = $('<div class="bop-popup-content"></div>');

                for (let i = 1; i < json.length; i++) {
                    $popup_content.append('<span class="number">' + json[i].v.n + '</span> ' + json[i].v.t + ' ');
                }

                $popup.append($popup_title);
                $popup.append($popup_content);
                $popup.addClass("loaded");
            });

        $("body").append($popup);
    });

    let closeTimer;

    $(document).on("mouseleave", ".bop-ref, .bop-popup", function () {
        closeTimer = setTimeout(function () {
            $('.bop-popup').remove();
        }, 300);
    });

    $(document).on("mouseenter", ".bop-ref, .bop-popup", function () {
        if (closeTimer) {
            closeTimer = clearTimeout(closeTimer);
        }
    });
});