<template>
  <div>
    <div class="row">
      <div class="col-lg-3">
        <div class="card bg-gradient-info border-0">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Pacientes</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="count_patients">{{ count_patients }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                  <i class="ni ni-single-02"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card bg-gradient-primary border-0">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Citas Reservadas</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="pendingAppointments">{{ pendingAppointments }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
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
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Citas Confirmadas</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="confirmedAppointments">{{ confirmedAppointments }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
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
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Citas Atendidas</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="attendedAppointments">{{ attendedAppointments }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
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
        return{
          count_patients: '',
          pendingAppointments: '',
          confirmedAppointments: '',
          attendedAppointments: ''
        };
      },

      mounted(){

        axios.get('count_patients')
        .then((response) => {
          this.count_patients = response.data;
        });

        axios.get('pendingAppointments')
        .then((response) => {
          this.pendingAppointments = response.data;
        });

        axios.get('confirmedAppointments')
        .then((response) => {
          this.confirmedAppointments = response.data;
        });

        axios.get('attendedAppointments')
        .then((response) => {
          this.attendedAppointments = response.data;
        });

      }

    }
</script>
