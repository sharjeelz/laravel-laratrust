<template>
    <div class="col-sm-4 col-xxxl-3">
        <a class="element-box el-tablo">
            <div class="label">Doctors</div>
            <div class="value">{{new_total_docs}}</div>
            <!-- <div class="trending trending-up-basic">
                <span>12%</span>
                <i class="os-icon os-icon-arrow-up2"></i>
            </div> -->
        </a>
    </div>
</template>

<script>

    export default {

        props: ['total_docs'],

        data(){
            return {
                new_total_docs: this.total_docs
            }
        },

          mounted() {

            Echo.channel('doctor-update').listen('DoctorEvent',(doctor)=>{

              this.new_total_docs= doctor.total_doctors

              console.log(doctor);

        })
     }



    }
</script>
