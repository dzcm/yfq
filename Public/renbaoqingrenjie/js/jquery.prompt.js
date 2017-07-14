(function (T) {

    T.extend({

        prompt: function (text, type, times, callback) {

            (function (element) {

                if (!!element) {

                    element = $(element.join('')).appendTo('body');
                    element.css({
                        'marginLeft': -((element.width() + 7 * 2 /*padding*/) / 2),
                        'marginTop': -((element.height() + 7 * 2 /*padding*/) / 2)
                    });
                    element.fadeIn();

                    times = times || 2000;

                    setTimeout(function () {

                        if (!!element) {

                            element.fadeOut(function () {
                                element.remove();
                                !!callback && callback();
                            });
                        }

                    }, times);
                }

            })(['<div class="prompt"><div class="i"><div class="', type, '"></div></div><div class="info">', text, '</div></div>']);
        },
        confirm: function (text, ok_callback, no_callback) {
            (function (element) {
                if (!!element) {

                    element = $(element.join('')).appendTo('body');
                    element.css({
                        'marginLeft': -((element.width() + 7 * 2 /*padding*/) / 2),
                        'marginTop': -((element.height() + 7 * 2 /*padding*/) / 2)
                    });
                    element.fadeIn();

                    element.find("#confirm_ok").click(function () {
                        element.fadeOut(function () {
                            element.remove();
                            !!ok_callback && ok_callback();
                        });
                    });
                    element.find("#confirm_no").click(function () {
                        element.fadeOut(function () {
                            element.remove();
                            !!no_callback && no_callback();
                        });
                    });



                }

            })(['<div class="confirm_Panel"><div class="confirm_text">', text, '</div><div class="confirm_btn_Panel"><div id="confirm_ok" class="confirm_btn">确定</div><div id="confirm_no" class="confirm_btn">取消</div></div></div>'])
        }

    });

})(jQuery);