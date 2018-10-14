<template>
<div class="row">
    <div class="col-sm-4 col-xxxl-3">
        <a class="element-box el-tablo">
            <div class="label">Users</div>
            <div class="value">{{new_total_users}}</div>
        </a>
    </div>
    <div class="col-sm-4 col-xxxl-3">
        <a class="element-box el-tablo">
            <div class="label">Roles</div>
            <div class="value">{{new_total_roles}}</div>
        </a>
    </div>
    <div class="col-sm-4 col-xxxl-3">
        <a class="element-box el-tablo">
            <div class="label">Permissions</div>
            <div class="value">{{new_total_permissions}}</div>
        </a>
    </div>
    </div>

</template>

<script>

    export default {

        props: ['total_users','total_roles','total_permissions'],

        data(){
            return {
                new_total_users: this.total_users,
                new_total_roles: this.total_roles,
                new_total_permissions: this.total_permissions
            }
        },

          mounted() {

            Echo.channel('user-update').listen('UserEvent',(data)=>{



        })
     }



    }
</script>
