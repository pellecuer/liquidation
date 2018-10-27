///addRow
$(document).ready(function() {
    var table = $('#example').DataTable();
    var counter = 1;
    var checkbox = '';

    $('#addRow').on( 'click', function () {
        table.row.add( [
            'counter',
            'F',
            'G',
            '',
            '',
            '',
            '',
            '',
            checkbox
        ] ).draw( false );

        counter++;
    } );

    // Automatically add a first row of data
    //$('#addRow').click();
} );

//deleteRow
$(document).ready(function() {
    var table = $('#example').DataTable();

    $('#example tbody').on( 'click', '.trash', function () {
        let cel = $(this).closest('tr').find("td:nth-child(2)").html();
        let txt;
        let r = confirm("Etes-vous sûr de vouloir supprimer : \n"+ cel +' ?');
        if (r == true) {
            table
                .row( $(this).parents('tr') )
                .remove()
                .draw();
        } else {
            txt = "opération annulée!";
        }
        document.getElementById("titre").innerHTML = txt;

    } );
} );