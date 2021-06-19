jQuery(function ($) {
    $(".sidebar-dropdown > a").click(function () {
        $(".sidebar-submenu").slideUp(200);
        
        if($(this).next('div').hasClass('d-block')){
            $(this).next('div').slideUp(200, () => {$(this).next('div').removeClass('d-block')});
        }

        if ($(this).parent().hasClass("active_side")) {
            $(".sidebar-dropdown").removeClass("active_side");
            $(this).parent().removeClass("active_side");
        } else {
            $(".sidebar-dropdown").removeClass("active_side");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active_side");
        }
    });

    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function () {
        $(".page-wrapper").addClass("toggled");
    });
});


let w = window.innerWidth;
if (w <= 660) {
    $(".page-wrapper").removeClass("toggled");
} else {
    $(".page-wrapper").addClass("toggled");
}

window.addEventListener("resize", () => {
    let w = window.innerWidth;
    if (w <= 660) {
        $(".page-wrapper").removeClass("toggled");
    } else {
        $(".page-wrapper").addClass("toggled");
    }
});


