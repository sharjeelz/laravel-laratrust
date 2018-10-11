<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="mymodal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Roles</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        &times;</span></button>
            </div>
            <div class="modal-body">
                    <form id="roles_users_form" method="POST">
                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-4">
                        <label for="">Select Role (s)</label>
                            </div>

                            <div class="col-md-8">
                        @foreach ($roles as $rol)

                        <input class="user_roles form-control" name="user_roles[]"  type="checkbox" value="{{$rol->id}}">{{$rol->name}}
                        @endforeach
                        <input id="userid" type="hidden" value="" name="user_id">
                            </div>

                        </div>
                    </div>

            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" type="button">
                    Close</button>
                <button id="save_user_roles" class="btn btn-primary" type="submit">
                    Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="mymodalp" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permissions</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        &times;</span></button>
            </div>
            <div class="modal-body">
                    <form id="permissions_users_form" method="POST">
                    <div class="form-group">
                        <div class="row">

                            <div class="col-md-4">
                        <label for="">Select Permission (s)</label>
                            </div>

                            <div class="col-md-8">
                        @foreach ($permissions as $perm)

                        <input class="user_permissions form-control" name="user_permissions[]"  type="checkbox" value="{{$perm->id}}">{{$perm->name}}
                        @endforeach
                        <input id="useridp" type="hidden" value="" name="user_id">
                            </div>

                        </div>
                    </div>

            <div class="modal-footer">
                <button class="btn btn-danger" data-dismiss="modal" type="button">
                    Close</button>
                <button id="save_user_roles" class="btn btn-primary" type="submit">
                    Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>


