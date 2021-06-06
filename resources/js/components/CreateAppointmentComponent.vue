<template>
<div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="specialty">Especialidad</label>
            <select v-model="selected_specialty" @change="loadDoctors" class="form-control selectpicker" name="specialty_id" id="specialty" data-style="btn-secondary" required>
                <option value="">Seleccione una especialidad</option>
                <option v-for="specialty in specialties" v-bind:value="specialty.id">
                    {{ specialty.name }}
                </option>

            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="doctor">Medico</label>
            <select v-model="selected_doctor" class="form-control" name="doctor_id" id="doctor" required>
                <option value="">Seleccione un médico</option>
                <option v-for="(doctor) in doctors" v-bind:value="doctor.id">
                    {{ doctor.name }}
                </option>

            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="name">Fecha</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
            </div>
            <input v-model="selected_date" @change="loadHours" class="form-control datepicker" placeholder="Seleccionar fecha" id="date" name="schedule_date" type="text">
        </div>
    </div>

    <div class="form-group">
        <label for="address">Hora de Atención</label>
        <div v-if="intervals.length == 0 && boolean == false" class="alert alert-info" role="alert">
            Seleccione un médico y una fecha para ver sus horarios disponibles.
        </div>
        <div v-else-if="boolean == true" class="alert alert-danger" role="alert">
            <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el medico en el dia seleccionado.
        </div>
        <div v-else>
            <div class="row">
                <div class="col-sm">
                    <label>Turno-Tarde</label>
                    <div v-for="(item, index) in afternoon" class="custom-control custom-radio mb-3">
                        <input name="schedule_time" v-model="selected_interval" v-bind:value="item.start" class="custom-control-input" v-bind:id="'afternoon'+index" type="radio" required>
                        <label class="custom-control-label" v-bind:for="'afternoon'+index">
                            {{ item.start }} - {{ item.end }}
                        </label>
                    </div>
                </div>
                <div class="col-sm">
                    <label>Turno-Mañana</label>
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
export default {
    data() {
        return {
            selected_specialty: '',
            selected_doctor: '',
            selected_date: '',
            selected_interval: '',
            date: '',
            boolean: false,
            doctors: [],
            specialties: [],
            intervals: [],
            afternoon: [],
            morning: [],
        };
    },

    mounted() {
        document.getElementById("doctor").disabled = true;

        document.getElementById("date").disabled = true;

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

        $(document).ready(() => {
            $('#date').datepicker('val');
        });
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
                        document.getElementById("date").disabled = false;
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
