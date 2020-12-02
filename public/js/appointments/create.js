let $doctor, $date, $specialty, $hours;
let iRadio;
const noHoursAlert = `<div class="alert alert-danger" role="alert">
    <strong>Lo sentimos!</strong> No se encontraron horas disponibles para el medico en el dia seleccionado.
</div>
`;

$(function() {
  $specialty = $('#specialty');
  $doctor = $('#doctor');
  $date = $('#date');
  $hours = $('#hours');

  $specialty.change(()=>{
    const specialtyId = $specialty.val();
    const url = `/api/specialties/${specialtyId}/doctors`;
    $.getJSON(url, onDoctorLoaded);
  });

  $doctor.change(loadHours);
  $date.change(loadHours);

});
  function onDoctorLoaded(doctors){
    let htmlOptions = '';
    doctors.forEach(doctor_select => {
      //console.log(`${doctor.id}`)
      htmlOptions += `<option value = "${doctor_select.user_id}">${doctor_select.name}  ${doctor_select.lastname}</option>`
    });
    $doctor.html(htmlOptions);
    loadHours();
  }

  function loadHours() {
    const selectedDate = $date.val();
    const doctorId = $doctor.val();
    const url = `/api/schedule/hours/?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
  }

  function displayHours(data){
    if(!data.morning && !data.afternoon){
      $hours.html(noHoursAlert);
      //console.log('No se encontraron horas disponibles para el medico en el dia seleccionado.');
      return;
    }

    let htmlHours = '';
    iRadio = 0;

    if (data.morning) {
      const morning_intervals = data.morning;
      morning_intervals.forEach(interval => {
        htmlHours += getRadioIntervalHtml(interval);
        //console.log(`${interval.start} - ${interval.end}`);
      });
    }

    if (data.afternoon) {
      const afternoon_intervals = data.afternoon;
      afternoon_intervals.forEach(interval => {
        htmlHours += getRadioIntervalHtml(interval);
        //console.log(`${interval.start} - ${interval.end}`);
      });
    }
    $hours.html(htmlHours);
  }

function getRadioIntervalHtml(interval){
    const text = `${interval.start} - ${interval.end}`;

    return `<div class="custom-control custom-radio mb-3">
  <input name="schedule_time" value="${interval.start}" class="custom-control-input" id="interval${iRadio}" type="radio" required>
  <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
</div>`;
  }
