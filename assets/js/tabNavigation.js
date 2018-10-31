$( "td" ).keypress(function( event ) {
    if ( event.which == 13 ) {
        $(this).text("coucou").css("background-color", "red").fadeOut("3000");
        $(this).next("td").focus();
        }
    });