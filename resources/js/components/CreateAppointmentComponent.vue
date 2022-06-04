<template>
<div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="form-control-label">Especialidad</label>
            <select v-model="selected_specialty" @change="loadDoctors" class="form-control selectpicker" name="specialty_id" id="specialty" data-style="btn-secondary" required>
                <option value="">Seleccione una especialidad</option>
                <option v-for="specialty in specialties" v-bind:value="specialty.id">
                    {{ specialty.name }}
                </option>

            </select>
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Médico</label>
            <select v-model="selected_doctor" class="form-control" name="doctor_id" id="doctor" required>
                <option value="">Seleccione un médico</option>
                <option v-for="(doctor) in doctors" v-bind:value="doctor.id">
                    {{ doctor.name }}
                </option>

            </select>
        </div>

    <div class="form-group col-md-4">
        <label class="form-control-label">Fecha</label>
        
         <!-- <div class="input-group">
            <date-picker ref="datepicker" class="col-md-6" v-model="selected_date" @change="loadHours" placeholder="Seleccionar fecha" id="schedule_date" valueType="format" :disabled="disableDatePicker" type="date"></date-picker>
        </div> -->

        <!-- <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
            </div>
            <input @change="loadHours" v-model="selected_date" class="form-control datepicker" placeholder="Seleccionar fecha"
            v-bind:id="'schedule_date'" name="schedule_date" type="text">
        </div> -->

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
            </div>
            <date-picker class="form-control" id="schedule_date" name="schedule_date" @input="loadHours" placeholder="Seleccionar fecha" v-model="selected_date" :disabled="disableDatePicker" :config="options"></date-picker>
        </div>
        
        <!-- <date-picker v-model="test_date" valueType="format"></date-picker> -->
    </div>
    </div>

    <div class="form-group">
        <label class="form-control-label">Hora de Atención</label>
        <div v-if="intervals.length == 0 && boolean == false" class="alert alert-info" role="alert">
            Seleccione un médico y una fecha para ver sus horarios disponibles.
        </div>
        <div v-else-if="boolean == true" class="alert alert-danger" role="alert">
            <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el medico en el dia seleccionado.
        </div>
        <div v-else>
            <div class="form-row">
                <div class="col-md-6">
                    <label class="form-control-label">Turno-Tarde</label>
                    <div v-for="(item, index) in afternoon" class="custom-control custom-radio mb-3">
                        <input name="schedule_time" v-model="selected_interval" v-bind:value="item.start" class="custom-control-input" v-bind:id="'afternoon'+index" type="radio" required>
                        <label class="custom-control-label" v-bind:for="'afternoon'+index">
                            {{ item.start }} - {{ item.end }}
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-control-label">Turno-Mañana</label>
                    <div v-for="(item, index) in morning" class="custom-control custom-radio mb-3">
                        <input name="schedule_time" v-model="selected_interval" v-bind:value="item.start" class="custom-control-input" v-bind:id="'morning'+index" type="radio" required>
                        <label class="custom-control-label" v-bind:for="'morning'+index">
                            {{ item.start }} - {{ item.end }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

/* import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css'; */

/* import DatePicker from 'bootstrap-datepicker'; */

import DatePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

export default {
  components: { DatePicker },
    data() {
        return {
            selected_specialty: '',
            selected_doctor: '',
            selected_date: '',
            disableDatePicker: '',
            selected_interval: '',
            boolean: false,
            doctors: [],
            specialties: [],
            intervals: [],
            afternoon: [],
            morning: [],
            options: {
                format: 'YYYY-MM-DD',
                useCurrent: false,
            },
        };
    },

    mounted() {
        document.getElementById("doctor").disabled = true;

     

         this.disableDatePicker = true; 
        // Cambiar el atributo "name" del datepicker vue2-datepicker - Es la unica forma
        // this.$refs.datepicker.$refs.input.name = 'schedule_date';

        // var vm = this
        //   $('#date').datepicker({
        //     onSelect: function(dateText) {
        //       vm.date = dateText
        //     }
        //  })
        axios.get('get/specialtiesAll')
            .then((response) => {
                this.specialties = response.data;
            });

      //       $('.with-calendar').datepicker({
      //     weekStart: 1,
      //     language: 'de',
      //     bootcssVer: 3,
      //     format: "yyyy-mm-dd",
      //     viewformat: "yyyy-mm-dd",
      //     autoclose: true
      // }).on('changeDate', function (event) { // Communicate datetimepicker result to vue
      //     let inputFields = event.target.getElementsByTagName('input'); // depends on your html structure
      //     for (let i = 0; i < inputFields.length; i++) {
      //         inputFields[i].dispatchEvent(new Event('input', {'bubbles': true}));
      //     }
      // });

        // $('.schedule_date').datepicker({
        //     weekStart: 1,
        //     language: 'de',
        //     bootcssVer: 3,
        //     format: "yyyy-mm-dd",
        //     viewformat: "yyyy-mm-dd",
        //     autoclose: true
        // }).on('changeDate', function (event) { // Communicate datetimepicker result to vue
        //     let inputFields = event.target.getElementsByTagName('input'); // depends on your html structure
        //     for (let i = 0; i < inputFields.length; i++) {
        //         inputFields[i].dispatchEvent(new Event('input', {'bubbles': true}));
        //     }
        // });
    },

    methods: {
        loadDoctors() {
            this.selected_doctor = '';

            document.getElementById("doctor").disabled = true;

            if (this.selected_specialty != '') {
                axios.get('get/doctors', {
                        params: {
                            specialty_id: this.selected_specialty
                        }
                    })
                    .then((response) => {
                        this.doctors = response.data;
                        document.getElementById("doctor").disabled = false;
                        this.disableDatePicker = false;
                    });
            }

        },

        loadHours() {
            this.selected_interval = '';
            this.intervals = [];
            this.afternoon = [];
            this.morning = [];

            if (this.selected_date != '') {
                axios.get('get/hours', {
                        params: {
                            date: this.selected_date,
                            doctor_id: this.selected_doctor
                        }
                    })
                    .then((response) => {

                        this.intervals = response.data;
                        if (this.intervals.length == 0) {
                            this.boolean = true;
                        } else {
                            this.boolean = false;
                            this.afternoon = this.intervals.afternoon;
                            this.morning = this.intervals.morning;
                        }
                    });
            }
        }
    }
}
</script>
