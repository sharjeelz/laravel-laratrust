<template>
<div>
   <alert  v-model="showAlert" placement="top" duration="3000" type="success" width="400px" dismissable>
  <span class="icon-ok-circled alert-icon-float-left"></span>
  <strong>Update</strong>
  <p>Doctor {{doc_name}} Has been {{event}}</p>
</alert>
</div>
</template>

<script>
    import { alert } from 'vue-strap'
    export default {
components: {
    alert
  },

  props: [],

  data() {

      return {
          showAlert: false,
          doc_name: '',
          event: ''
      }
  },
   mounted() {

            Echo.channel('doctor-update').listen('DoctorEvent',(doctor)=>{

                this.doc_name=doctor.doctor.name,
                this.showAlert= true
                this.event= doctor.event

        })
     }


    }
</script>
