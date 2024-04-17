$(document).ready(function() {
    // Activate first tab by default
    $(".tabs-nav li:first").addClass("active");
    $(".tab-content:first").addClass("active");

    // Tab click event
    $(".tab-link").click(function() {
        var tabId = $(this).attr("data-tab");

        $(".tab-link").removeClass("active");
        $(".tab-content").removeClass("active");

        $(this).addClass("active");
        $("#" + tabId).addClass("active");
    });
});
