const app = new Vue({
    el: '#app',
    data: {
      selected_specialty: '',
      selected_doctor: '',
      selected_date: '',
      selected_interval: '',
      doctors:[],
      intervals:[],
      afternoon:[],
      morning:[],
    },
    methods:{

      loadDoctors(){
        axios.get('doctors', {params: {specialty_id: this.selected_specialty} })
        .then((response) => {
          this.doctors = response.data;
        });
      },

      loadHours(){
        axios.get('hours', {params: {date: this.selected_date, doctor_id: this.selected_doctor} })
        .then((response) => {
          this.intervals = response.data;
          this.afternoon = this.intervals.afternoon;
          this.morning = this.intervals.morning;
          console.log(this.intervals);
          console.log(this.afternoon);
          console.log(this.morning);
        });
      }
    }
});
