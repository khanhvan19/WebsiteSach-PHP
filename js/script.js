$(document).ready(function() {
    var h_top_header = $('#top-header').outerHeight() + $('#logo-res').outerHeight();
    $(window).scroll(function() {
        if ($(window).scrollTop() >= h_top_header) {
            $('#stickyheader').addClass("sticky");
            $('main').addClass("buffer-sticky");
        } else {
            $('#stickyheader').removeClass("sticky");
            $('main').removeClass("buffer-sticky");
        }
    })

});