function makeDataTable()
{

$('#doctortable').DataTable({
    "processing": false,
    "order": [],
    columnDefs: [ {
        orderable: false,
       //\ className: 'select-checkbox',
       "targets": [ 5 ],
       "visible": false,
       "searchable": true
    } ],
    initComplete: function () {
        this.api().columns(5).every( function () {
            var column = this;

            var select = $('<select class="form-control form-control-sm aria-controls="doctortable""><option value=""></option></select>')
                .appendTo( $('#doctortable_filter') )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );
                select.wrap( "<label>Blocked</label>" );
            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
    }
});
}