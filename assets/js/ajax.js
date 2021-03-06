//Event handlers
$(".editFor" ).on( "mouseenter", function(){
    //$( this).css( "background-color", "#C6E2FF");
    //$('html,body').css('cursor','crosshair');
    $(this).attr('contenteditable', 'true');
});
$(".editFor" ).on( "mouseleave", function(){
    //$( this).css( "background-color", "transparent");
    //$('html,body').css('cursor','crosshair');
    $(this).attr('contenteditable', 'false');
});
$(".editFor" ).on( "keypress", function(){
    //$('html,body').css('cursor','crosshair');
    $(this).text('');
});

//Check
$('.editFor').on( "keyup", function(){
    var personnage = $(this).html();
    $.ajax({
        url:'/ajax_request',
        type: "POST",
        dataType: "json",
        data: {
            "personnage": personnage
        },
        async: true,
        success: function (data)
        {
            console.log(data);
            $( '#titre' ).text(data.titre);
            $( '#producteur' ).text(data.producteur);
        }
    });
});

//StartDate enDate
$('.btn').on( "click", function(){
    //var startDate = $("#startDate").val();
    //var endDate = $("#endDate").val();
    var startDate = $('input[name="start"]').val();
    var endDate = $('input[name="start"]').val();

    $.ajax({
        url:'/agenda/team',
        type: "POST",
        dataType: "json",
        data: {
            "startDate": startDate,
            "endDate": endDate
        },
        async: true,
        success: function (data)
        {
            console.log(data);
            $( '#titre' ).text(data.titre);
            $( '#producteur' ).text(data.producteur);
        }
    });
});




//delete object in DB
$('.trash').on( "click", function(){
    //$(this).closest('tr').remove();
    var personnage = $(this).closest('tr').find("td:nth-child(1)").html();

    $( '#var' ).text(personnage);
});

//update object in DB
$('.update').on( "click", function(){
    //$(this).closest('tr').remove();
    var personnage = $(this).closest('tr').find("td:nth-child(2)").html();

    $( '#var' ).text(personnage);
});




