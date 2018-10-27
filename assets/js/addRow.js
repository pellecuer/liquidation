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
        table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } );
} );