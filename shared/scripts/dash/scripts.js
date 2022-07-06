/**
 * CONTROLADOR DO SIDEBAR
 */
$(function () {
    let minWidth = 992 - 18;
    let windowSize = getWindowSize();
    let toggler = $(".jsSidebarToggler");
    let sidebar = $(".jsDashboardSidebar");

    updateSidebarStyle();

    toggler.on("click", function (e) {
        e.preventDefault();
        if (sidebar.hasClass("d-none")) {
            sidebar.removeClass("d-none");
            toggler.css({
                "margin-left": sidebar.width() + "px"
            });
            togglerCloseIcon();
            addBackdrop("sidebarbkdrop", "fixed", null, null);
        } else {
            sidebar.addClass("d-none");
            toggler.css({
                "margin-left": 0
            });
            togglerOpenIcon();
            removeBackdrop("sidebarbkdrop");
        }
    });

    $(window).on("resize", function () {
        windowSize = getWindowSize();
        updateSidebarStyle();
    });

    function updateSidebarStyle() {
        if (windowSize <= minWidth) {
            sidebar.removeClass("desktop").addClass("mobile");
        } else {
            sidebar.removeClass("mobile").addClass("desktop");
        }
    }

    function getWindowSize() {
        return $(window).width();
    }

    function togglerOpenIcon() {
        toggler.removeClass(toggler.attr("data-alt-icon")).addClass(toggler.attr("data-active-icon"));
    }

    function togglerCloseIcon() {
        toggler.removeClass(toggler.attr("data-active-icon")).addClass(toggler.attr("data-alt-icon"));
    }
});
