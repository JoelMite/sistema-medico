<template>
<!-- <div class="card shadow"> -->
<div class="card">
    <div v-if="showModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detalles de la Cita Médica</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Descripción</th>
                                                <td>{{info.description}}</td>
                                            </tr>
                                            <tr>
                                                <th v-if="role_doctor == true" scope="row">Paciente</th>
                                                <td v-if="role_doctor == true">{{info.patient.person.name}}</td>
                                            </tr>
                                            <tr>
                                                <th v-if="role_patient == true" scope="row">Médico</th>
                                                <td v-if="role_patient == true">{{info.doctor.person.name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Fecha</th>
                                                <td>{{info.schedule_date}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Hora</th>
                                                <td>{{info.schedule_time_12}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Especialidad</th>
                                                <td>{{info.specialty.name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tipo</th>
                                                <td>{{info.type}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Estado</th>
                                                <td>{{info.status}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="showModal = false">Cerrar</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
    <div class="card-body">
        <div class="table-responsive py-4">
            <table class="table table-striped table-bordered" id="datatable-pending">
                <thead class="thead-light">
                    <tr>
                        <!-- <th>Descripción</th> -->
                        <th>Especialidad</th>
                        <th v-if="role_doctor == true">Paciente</th>
                        <th v-if="role_patient == true">Médico</th>
                        <th v-if="user == true">Usuario</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <!-- <th>Tipo</th> -->
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="appointments in pendingAppointments">
                        <!-- <td>{{ appointments.description }}</td> -->
                        <td>{{ appointments.specialty.name }}</td>
                        <td v-if="appointments.patient">{{ appointments.patient.person.name }}</td>
                        <td v-if="appointments.doctor">{{ appointments.doctor.person.name }}</td>
                        <td v-if="user == true"></td>
                        <td>{{ appointments.schedule_date }}</td>
                        <td>{{ appointments.schedule_time_12 }}</td>
                        <!-- <td>{{ appointments.type }}</td> -->
                        <td>
                            <!-- <a class="btn btn-sm btn-primary" title="Ver cita"
                        v-bind:href="/appointment_medicals_doctor/+appointments.id">
                          Ver
                      </a> -->

                            <button class="btn btn-sm btn-warning" title="Ver cita" type="button" @click="showModalAppointment(appointments)">
                                Ver
                            </button>

                            <form v-if="role_doctor == true" class="d-inline-block">
                                <button class="btn btn-sm btn-success" type="submit" @click.prevent="postConfirmAppointment(appointments)" data-toggle="tooltip" title="Confirmar cita">
                                    <i class="ni ni-check-bold"></i>
                                </button>
                            </form>

                            <form class="d-inline-block">
                                <button class="btn btn-sm btn-danger" type="submit" @click.prevent="postCancelAppointment(appointments)" data-toggle="tooltip" title="Cancelar cita">
                                    <i class="ni ni-fat-delete"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                </tbody>
                <!-- <tfoot>
                <tr>
                    <th>Descripción</th>
                    <th>Especialidad</th>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Tipo</th>
                    <th>Opciones</th>
                </tr>
            </tfoot> -->
            </table>
        </div>
    </div>
</div>
<!-- </div> -->
</template>

<script>
import datatable from 'datatables.net-bs4';
import $ from 'jquery';
import notify from 'bootstrap-notify';
//import bootstrap from 'bootstrap';

export default {
    data() {
        return {
            pendingAppointments: [],
            info: [],
            showModal: false,
            role_doctor: false,
            role_patient: false,
            user: true,
            // appointment_id: '',
        };
    },

    mounted() {

        // axios.get('indexpendingAppointments')
        //     .then((response) => {
        //       this.pendingAppointments = response.data;
        //     });

        // this.$nextTick(() => {
        //   $('#example').DataTable();
        // });

        this.getAppointments()


    },

    methods: {
        mytable() {
            $(function() {
                $('#datatable-pending').DataTable({
                    language: {
                        paginate: {
                            next: '<i class="fas fa-angle-right"></i>',
                            previous: '<i class="fas fa-angle-left"></i>',
                            first: '<i class="fas fa-angle-double-left"></i>',
                            last: '<i class="fas fa-angle-double-right"></i>'
                        },

                        sProcessing: 'Procesando...',
                        sLengthMenu: 'Mostrar _MENU_ registros',
                        sZeroRecords: 'No se encontraron resultados',
                        sEmptyTable: 'Ningún dato disponible en esta tabla',
                        sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                        sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
                        sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
                        sInfoPostFix: '',
                        sSearch: 'Buscar:',
                        sUrl: '',
                        sInfoThousands: ',',
                        sLoadingRecords: 'Cargando...',

                    }
                });
            });
        },

        getAppointments() {
            axios.get('indexpendingAppointments').then(response => {
                this.pendingAppointments = response.data;

                $('#datatable-pending').DataTable().destroy();
                this.mytable()
                if (this.pendingAppointments[0].patient) {
                    this.role_patient = false;
                    this.role_doctor = true;
                    this.user = false;
                } else if (this.pendingAppointments[0].doctor) {
                    this.role_doctor = false;
                    this.role_patient = true;
                    this.user = false;
                }
                // let pendingAppointments = JSON.parse(JSON.stringify(this.pendingAppointments));
                // for (var i = 0; i < pendingAppointments.length; i++) {
                //   pendingAppointments[i];
                //   if (pendingAppointments.patient) {
                //     this.role_doctor = true;
                //   }
                //   break;
                // }

            }).catch(error => {
              console.log(error)
              this.errored = true
            })
            .finally(() => this.loading = false);

        },

        postConfirmAppointment(appointment) {
            // this.appointment_id = appointment.id
            axios.post('appointment_medicals/' + appointment.id + '/confirm').then(response => {
                this.getAppointments();
                this.$root.$emit('pending_confirm');
                $.notify({
                    title: '<strong>Exito!</strong><br>',
                    message: 'Cita Confirmada con Exito'
                }, {
                    type: 'success',
                    animate: {
                        enter: 'animated bounceInDown',
                        exit: 'animated bounceOutUp'
                    }
                });

            }).catch(error => {
              console.log(error)
              this.errored = true
            })
            .finally(() => this.loading = false);
        },

        postCancelAppointment(appointment) {
            axios.post('appointment_medicals/' + appointment.id + '/cancel').then(response => {
                this.getAppointments();
                this.$root.$emit('pending_cancel');
                $.notify({
                    title: '<strong>Exito!</strong><br>',
                    message: 'Cita Cancelada con Exito'
                }, {
                    type: 'success',
                    animate: {
                        enter: 'animated bounceInDown',
                        exit: 'animated bounceOutUp'
                    }
                });

            }).catch(error => {
              console.log(error)
              this.errored = true
            })
            .finally(() => this.loading = false);
        },

        showModalAppointment(appointment) {
            this.info = appointment;
            this.showModal = true;
            //$('#modalShow').modal('show');
        },

    },

}
</script>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
</style>
