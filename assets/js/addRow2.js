$(document).ready( function () {
    var table = $('#example').DataTable( {
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": '<input id="check" type="checkbox">'
        }]
    });

    $('#addRow').on( 'click', function () {
        var data = table.row( $(this).parents('tr') ).data();
        console.log("clicked on " + data[0]);
    } );
} );