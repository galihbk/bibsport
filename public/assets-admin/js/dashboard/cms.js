$(document).on("click", ".SlideToolHeader", function () {
    var el = $(this).hasClass("expand");
    if (el) {
        $(this).removeClass("expand").addClass("collapse");
        $(this)
            .closest(".cm-content-box")
            .find(".cm-content-body")
            .slideUp(300);
        $(this).closest(".content-title").addClass("collapse");
    } else {
        $(this).removeClass("collapse").addClass("expand");
        $(this)
            .closest(".cm-content-box")
            .find(".cm-content-body")
            .slideDown(300);
        $(this).closest(".content-title").removeClass("collapse");
    }
});
var salreoCms = (function () {
    var slider = function () {
        jQuery(".SlideToolHeader").on("click", function () {
            var el = jQuery(this).hasClass("expand");
            if (el) {
                jQuery(this).removeClass("expand").addClass("collapse");
                jQuery(this)
                    .closest(".cm-content-box")
                    .find(".cm-content-body")
                    .slideUp(300);
                jQuery(this).closest(".content-title").addClass("collapse");
            } else {
                jQuery(this).removeClass("collapse").addClass("expand");
                jQuery(this)
                    .closest(".cm-content-box")
                    .find(".cm-content-body")
                    .slideDown(300);
                jQuery(this).closest(".content-title").removeClass("collapse");
            }
        });

        $(document).ready(function () {
            $(".open").on("click", function () {
                $(".main-check").slideToggle("slow");
            });
        });
    };

    /* Function ============ */
    return {
        init: function () {
            slider();
        },

        load: function () {},

        resize: function () {
            //vHeight();
        },
    };
})();

/* Document.ready Start */
jQuery(document).ready(function () {
    $('[data-bs-toggle="popover"]').popover();
    ("use strict");
    salreoCms.init();
});
/* Document.ready END */

/* Window Load START */
jQuery(window).on("load", function () {
    "use strict";
    salreoCms.load();
});
/*  Window Load END */
/* Window Resize START */
jQuery(window).on("resize", function () {
    "use strict";
    salreoCms.resize();
});
/*  Window Resize END */
