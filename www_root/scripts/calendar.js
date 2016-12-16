


function loadKalendar(month, year){

    $.ajax({type: "POST",
        url: "/ajax/calendar",
        data: { month:month, year:year }
    }).done(function( data ) {

        $(".calendarThere").html(data);


    });

}



