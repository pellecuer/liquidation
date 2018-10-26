///addRow
$(document).ready(function() {
    var table = $('#example').DataTable();
    var counter = 1;
    var checkbox = 'coco';

    $('#addRow').on( 'click', function () {
        table.row.add( [
            'J',
            'J',
            'J',
            'H',
            'H',
            checkbox
        ] ).draw( false );

        counter++;
    } );

    // Automatically add a first row of data
    $('#addRow').click();
} );

//deleteRow
$(document).ready(function() {
    var table = $('#example').DataTable();

    $('#example tbody').on( 'click', '#icon-delete', function () {
        table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    } );
} );