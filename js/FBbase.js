 //  tooltip   
     $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();
     });

// back to top 
    $(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');
});

// sfondo campi di input -->

$(document).ready(function(){
$("input").focus(function(){
    $(this).css("background","aqua");
});
$("input").blur(function(){
    $(this).css("background","white");
});
$("textarea").focus(function(){
    $(this).css("background","aqua");
});
$("textarea").blur(function(){
    $(this).css("background","white");
});
$("select").focus(function(){
    $(this).css("background","aqua");
});
$("select").blur(function(){
    $(this).css("background","white");
});
$("label").prop( "tabindex", -1 );

});
