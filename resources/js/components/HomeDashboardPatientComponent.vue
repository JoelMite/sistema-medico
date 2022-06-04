<template>
    <div>
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 d-inline-block mb-0">Paciente</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card bg-gradient-primary border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5
                                    class="card-title text-uppercase text-muted mb-0 text-white"
                                >
                                    Citas Reservadas
                                </h5>
                                <span
                                    class="h2 font-weight-bold mb-0 text-white"
                                    v-bind:value="pendingAppointments"
                                    >{{ pendingAppointments }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div
                                    class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                >
                                    <i class="ni ni-bell-55"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-gradient-warning border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5
                                    class="card-title text-uppercase text-muted mb-0 text-white"
                                >
                                    Citas Confirmadas
                                </h5>
                                <span
                                    class="h2 font-weight-bold mb-0 text-white"
                                    v-bind:value="confirmedAppointments"
                                    >{{ confirmedAppointments }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div
                                    class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                >
                                    <i class="ni ni-collection"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card bg-gradient-danger border-0">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5
                                    class="card-title text-uppercase text-muted mb-0 text-white"
                                >
                                    Citas Atendidas
                                </h5>
                                <span
                                    class="h2 font-weight-bold mb-0 text-white"
                                    v-bind:value="attendedAppointments"
                                    >{{ attendedAppointments }}</span
                                >
                            </div>
                            <div class="col-auto">
                                <div
                                    class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                >
                                    <i class="ni ni-check-bold"></i>
                                </div>
                            </div>
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
            pendingAppointments: "",
            confirmedAppointments: "",
            attendedAppointments: ""
        };
    },

    mounted() {
        axios
            .get("pendingAppointments", {
                params: {
                    role: "patient"
                }
            })
            .then(response => {
                this.pendingAppointments = response.data;
            });

        axios
            .get("confirmedAppointments", {
                params: {
                    role: "patient"
                }
            })
            .then(response => {
                this.confirmedAppointments = response.data;
            });

        axios
            .get("attendedAppointments", {
                params: {
                    role: "patient"
                }
            })
            .then(response => {
                this.attendedAppointments = response.data;
            });
    }
};
</script>
