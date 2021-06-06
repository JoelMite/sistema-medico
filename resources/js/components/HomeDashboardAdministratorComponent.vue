<template>
  <div>
    <div class="row">
      <div class="col-lg-3">
        <div class="card bg-gradient-info border-0">
          <!-- Card body -->
          <div class="card-body">
            <div class="row">
              <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Usuarios</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="count_users">{{ count_users }}</span>
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
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Activos</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="activeUsers">{{ activeUsers }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                  <i class="fas fa-user-check"></i>
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
                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Baneados</h5>
                <span class="h2 font-weight-bold mb-0 text-white" v-bind:value="bannedUsers">{{ bannedUsers }}</span>
              </div>
              <div class="col-auto">
                <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                  <i class="fas fa-user-times"></i>
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
          count_users: '',
          bannedUsers: '',
          activeUsers: ''
        };
      },

      mounted(){

        axios.get('count_users')
        .then((response) => {
          this.count_users = response.data;
        });

        axios.get('bannedUsers')
        .then((response) => {
          this.bannedUsers = response.data;
        });

        axios.get('activeUsers')
        .then((response) => {
          this.activeUsers = response.data;
        });

      }

    }
</script>
