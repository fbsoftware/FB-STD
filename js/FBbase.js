 //  tooltip   
     $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();
     });

// tornasu
    window.addEventListener ("scroll",function(){

    if (window.pageYOffset>300) {
    document.getElementById ("tornasu").style.display= "block";
    }

    else if (window.pageYOffset<300) {
    document.getElementById ("tornasu").style.display= "none";
    }

    val[0].innerHTML= "PageYOffset = "+window.pageYOffset
    },!1);

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
