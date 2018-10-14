



var table=$('#usertable').DataTable({
    "processing": false,
    "order": [],
    columnDefs: [ {
        orderable: false,
       //\ className: 'select-checkbox',
       "targets": [ 8 ],
       "visible": false,
       "searchable": true
    } ],
    initComplete: function () {
        this.api().columns(8).every( function () {
            var column = this;

            var select = $('<select class="form-control form-control-sm aria-controls="usertable""><option value=""></option></select>')
                .appendTo( $('#usertable_filter') )
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
    // select: {
    //     style:    'os',
    //     selector: 'td:first-child'
    // },
});


$('#outer_checkbox').on('change',function(){

    $('#usertable td').find('input:checkbox').each(function() {

        if($(this).is(':checked')){

            $(this).attr('checked',false);
        }
        else{
            $(this).attr('checked',true);

        }

    });


});

//Bulk Delete, If select All only the avaiable for deleting will be deleted, not soft deleted already
$('#bulkactionDelete').on('click',function(e){

    e.preventDefault();

    var selected_users = [];
    $('#usertable td').find('input:checked').each(function() {

        if(!$(this).data('trash')){
        selected_users.push($(this).val())
    }
    });
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    if(selected_users.length >0){
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
                url: "/admin/destroy/users",
                data: {_token: CSRF_TOKEN,data:selected_users},
                success: function (data) {

                    swal("Done!", "Users Blocked", "success");
                    window.location.reload();

                    }
            });
    });
}
else {

    return false;
}




});

//Bulk Restore, If select All only the avaiable for Resorting will be Restored
$('#bulkactionRestore').on('click',function(e){

    e.preventDefault();

    var selected_users = [];
    $('#usertable td').find('input:checked').each(function() {
        if($(this).data('trash')){
        selected_users.push($(this).val())
    }
    });
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    if(selected_users.length >0){
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
                url: "/admin/restore/users",
                data: {_token: CSRF_TOKEN,data:selected_users},
                success: function (data) {

                    swal("Done!", "Users Restored", "success");
                    window.location.reload();

                    }
            });
    });
}
else {

    return false;
}




});


$('#roletable').DataTable({

    "order": []
});

$('#permissionuser').DataTable({

    "order": []
});
$("#mymodal").on("hidden.bs.modal", function(){
    $.each($('.user_roles'),function(index,value){

        $(this).attr('checked',false);
        });
});

$("#mymodalp").on("hidden.bs.modal", function(){
    $.each($('.user_permissions'),function(index,value){

        $(this).attr('checked',false);
        });
});

$('#mymodal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var userid = button.data('userid')

    $('#userid').val(userid);


    var roles = button.data('roles')
    var rt=[];
    for(var y=0 ; y< roles.length ;y++){

        rt[y]=roles[y]['id'];

    }

    $.each($('.user_roles'),function(index,value){

    var tt=parseInt($(this).val());

    if(rt.includes(tt)){

    $(this).attr('checked',true);
    }







});

// var modal = $(this);
// modal.find('.modal-title').text('New message to ' + recipient)
// modal.find('.modal-body input').val(recipient)

  });

  $('#roles_users_form').on('submit',function(e){

    e.preventDefault();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var formData2=$(this).serialize();




    swal({
            title: "Confirm Assign?",
            type: "success",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/assign/role",
                data: {_token: CSRF_TOKEN, userid:$('#userid').val(), data:formData2},
                success: function (data) {

                    swal("Done!", "New Role (s) Assigned", "success");
                    window.location.reload();

                    }
            });
    });


  });



  $('#mymodalp').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var userid = button.data('userid')
    $('#useridp').val(userid);


    var permis = button.data('permissions')

    var rt=[];
    for(var y=0 ; y< permis.length ;y++){

        rt[y]=permis[y]['id'];

    }




    $.each($('.user_permissions'),function(index,value){

    var tt=parseInt($(this).val());

    if(rt.includes(tt)){

    $(this).attr('checked',true);
    }





});

});
$('#permissions_users_form').on('submit',function(e){

    e.preventDefault();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var formData2=$(this).serialize();




    swal({
            title: "Confirm Assign?",
            type: "success",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/assign/permission",
                data: {_token: CSRF_TOKEN, userid:$('#userid').val(), data:formData2},
                success: function (data) {

                    swal("Done!", "New Permission (s) Assigned", "success");
                    window.location.reload();

                    }
            });
    });


  });


//Delete User
$(document).on('click', '.delBtn', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
            title: "Are you sure to block "+name+" ?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/destroy/user",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {

                    console.log(data);
                    swal("Deleted!", "User Blocked", "success");

               window.location.reload();
                    }
            });
    });
});


//Delete Role
$(document).on('click', '.delBtnRole', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
            title: "Are you sure to delete this Role :  "+name+" ?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/destroy/role",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {


                   $('#tr-role-'+data).hide('slow',function(){

                    $(this).remove();

                swal("Deleted!", "Role Deleted", "success");
                   });
                    //window.location.href = "/admin/users";
                    }
            });
    });
});
//Delete Permission
$(document).on('click', '.delBtnPermission', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var name = $(this).data('name');
    swal({
            title: "Are you sure to delete "+name+" ?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/admin/destroy/permission",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {


                   $('#tr-'+data).hide('slow',function(){

                    $(this).remove();

                swal("Deleted!", "Permission Deleted", "success");
                   });
                    //window.location.href = "/admin/users";
                    }
            });
    });
});
//Send Password Email
$(document).on('click', '.sendPassowrdEmail', function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    e.preventDefault();
    var id = $(this).data('id');
    var email = $(this).data('email');
    swal({
        title: "Send Password Reset Email",
        text: "",
        type: "input",
        readOnly:true,
        showCancelButton: true,
        closeOnConfirm: false,
        inputValue: email,
        showLoaderOnConfirm: true
      },
      function(isConfirm){
        if (isConfirm) {
            setTimeout(function () {

              }, 2000);
            $.ajax({
                type: "POST",
                url: "/admin/reset/user/password",
                data: {_token: CSRF_TOKEN, email:email},
                success: function (data) {
                    window.location.reload();
                    swal("Success!", "Email Sent", "success");

                    }
            });
        } else {

        }
});
});
//Restore User
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
                url: "/admin/restore/user",
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {
                    window.location.reload();
                    swal("Restored!", "User Activated Successfuly", "success");


                    }
            });
    });

});


$('#mymodalusers').on('show.bs.modal', function (event) {


    var button = $(event.relatedTarget) // Button that triggered the modal
    var users = button.data('users')
    var role_name = button.data('name')
    $('#RoleUsers').html('Users Having '+ role_name+' Role');
    html ='';

    for(var t=0; t< users.length; t ++){

        html+='<tr>';
        html+='<td>'+users[t].name+'</td>';
        html+='<td>'+users[t].email+'</td>';
        html+='</tr>';


    }

    $('#userData').html(html);




});

$('#mymodalpermissions').on('show.bs.modal', function (event) {


    var button = $(event.relatedTarget) // Button that triggered the modal
    var users = button.data('users')

    console.log(users);
    var permission_name = button.data('name')
    $('#PermissionUsers').html('Users Having '+ permission_name+' Permission');
    html ='';

    for(var t=0; t< users.length; t ++){

        html+='<tr>';
        html+='<td>'+users[t].name+'</td>';
        html+='<td>'+users[t].email+'</td>';
        html+='</tr>';


    }

    $('#userPermissionData').html(html);




});


//Bulk Export
$('#bulkactionCsvForm').on('submit',function(e){



    var selected_users = [];
    $('#usertable td').find('input:checked').each(function() {

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