var table=$('#doctortable').DataTable({
    "processing": false,
    "order": [],
    columnDefs: [ {
        orderable: false,
       className: 'select-checkbox',
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

$('#outer_checkbox').on('click',function(){


    outer_val=$(this).prop('checked');
   if (outer_val) {

    $('#doctortable td').find(':checkbox').each(function() {

        $(this).prop('checked',true);

        });


   }
   else {

    $('#doctortable td').find(':checkbox').each(function() {

        $(this).prop('checked',false);

        });

   }




});



//Bulk Restore, If select All only the avaiable for Resorting will be Restored
$('#bulkactionRestore').on('click',function(e){

    e.preventDefault();

    var selected_doctors = [];
    $('#doctortable td').find('input:checked').each(function() {
        if($(this).data('trash')){
            selected_doctors.push($(this).val())
    }
    });
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    if(selected_doctors.length >0){
    swal({
            title: "Confirm Restore?",
            type: "success",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "doctors/massrestore",
                data: {_token: CSRF_TOKEN,selected_doctors:selected_doctors},
                success: function (data) {

                    swal("Done!", "Dccotors Restored", "success");
                    window.location.reload();

                    }
            });
    });
}
else {

    return false;
}




});

//Bulk Delete, If select All only the avaiable for deleting will be deleted, not soft deleted already
$('#bulkactionDelete').on('click',function(e){

    e.preventDefault();

    var selected_doctors = [];
    $('#doctortable td').find('input:checked').each(function() {

        if(!$(this).data('trash')){
            selected_doctors.push($(this).val())
    }
    });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    if(selected_doctors.length >0){
    swal({
            title: "Confirm Block?",
            type: "success",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "doctors/massdestroy",
                data: {_token: CSRF_TOKEN,selected_doctors:selected_doctors},
                success: function (data) {

                    swal("Done!", "Doctors Blocked", "success");
                    window.location.reload();

                    }
            });
    });
}
else {

    return false;
}




});

//Delete Doctor
$(document).on('click', '.delBtn', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $.trim($(this).data('id'));
    var name = $(this).data('name');
    console.log("doctors/"+$.trim(id));
    swal({
            title: "Are you sure to block "+name+" ?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "DELETE",
                url: "doctors/"+id,
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {

                swal("Deleted!", "Doctor Blocked", "success");

                window.location.reload();
                    }
            });
    });
});
//Restore Doctor
$(document).on('click', '.restoreBtn', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
            title: "Are you sure to Restore "+name+" ?",
            type: "info",
            confirmButtonClass: "btn-info",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "doctors/restore",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {
                   window.location.reload();
                   swal("Restored!", "Doctor Activated Successfuly", "success");


                    }
            });
    });

});
//Bulk Export
$('#bulkactionCsvForm').on('submit',function(e){



    var selected_users = [];
    $('#doctortable td').find('input:checked').each(function() {

        selected_users.push($(this).val())

    });

    if(selected_users.length >0){

        $('#bulkactionCsvFormData').val(selected_users);

    }
    else{

        e.preventDefault();
        return false;
    }



});