<template>
 <div  class="messages-notifications os-dropdown-trigger os-dropdown-position-left"><i class="os-icon os-icon-mail-14"></i>
            <div class="new-messages-count" v-if="notifications.length > 0">{{notifications.length}}</div>
            <div class="os-dropdown light message-list" v-if="notifications.length > 0">
               <ul>
                    <li  v-for="notification in notifications"><a href="#">
                            <div class="user-avatar-w"><i class="os-icon os-icon-arrow-right os-red"></i></div>
                            <div class="message-content">
                                <h6 class="message-from">{{notification.description}}</h6>
                                <h6 class="message-title"><timeago :datetime="notification.time" :auto-update="60"></timeago></h6>
                            </div>
                        </a></li>

                </ul>
            </div>
        </div>


</template>

<script>
import VueTimeago from 'vue-timeago'

Vue.use(VueTimeago, {
  name: 'Timeago',
  locale: 'en',
})

    export default {



  props: [],

  data() {

      return {
            notifications:[],
            description:''

      }
  },
   mounted() {

            Echo.channel('user-update').listen('UserEvent',(data)=>{

if (data.user != null ) {

    this.description ='User '+data.user.name+' Has Been '+ data.event;
}
if (data.role != null ) {

    this.description ='Role '+data.role.name+' Has Been '+ data.event;
}

if (data.permission != null ) {

    this.description ='Permisssion '+data.permission.name+' Has Been '+ data.event;
}
                    this.notifications.unshift({

                    description :this.description,
                    url: '/',
                    time: new Date()
                })


        })
     }


    }
</script>
