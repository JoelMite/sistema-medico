<template>
  <div class="form-row">
    <div class="col-md-6 mb-2">
      <div class="form-group">
        <label for="etnia">Etnia</label>
        <select v-model="etnia" class="form-control" id="etnia" data-style="btn-secondary" required>
          <option disabled value="">Seleccione una etnia</option>
            <option v-bind:value="'Mestizo'">Mestizo</option>
            <option v-bind:value="'Afroamericano'">Afroamericano</option>
            <option v-bind:value="'Indigena'">Indigena</option>
        </select>
      </div>
    </div>
   <div class="col-md-4 mb-2">
      <div class="form-group">
        <label for="name">Fecha de Nacimiento</label>
        <div v-bind:for="'date_birth'" class="input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
          </div>
          <input v-model="date_birth" class="form-control datepicker" placeholder="Seleccionar fecha"
          v-bind:id="'date_birth'" name="date_birth" type="text"
          data-date-format="yyyy-mm-dd">
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-2">
      <div class="form-group">
        <label for="sex">Sexo</label>
        <select v-model="sex" class="form-control" name="sex" id="sex" data-style="btn-secondary">
          <option disabled value="">Seleccione un género</option>
            <option v-bind:value="'Masculino'">Masculino</option>
            <option v-bind:value="'Femenino'">Femenino</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
      data() {
        return{
          etnia: '',
          date_birth: '',
          sex: ''
        };
      }
    }
</script>
