<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;

class StoreAppointment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    private $scheduleService;

    public function __construct(ScheduleServiceInterface $scheduleService){
      $this->scheduleService = $scheduleService;
    }

    public function rules()
    {
        return [
          'description' => 'required',
          'specialty_id' => 'exists:specialties,id',
          'doctor_id' => 'exists:users,id',
          'schedule_time' => 'required'
        ];
    }

    public function messages(){
      return[
        'schedule_time.required' => 'Por favor seleccione una hora valida para su cita'
      ];
    }

    public function withValidator($validator){

      $validator->after(function($validator) {
        $date = $this->input('schedule_date');
        $doctorId = $this->input('doctor_id');
        $schedule_time = $this->input('schedule_time');
        if (!$date || !$doctorId || !$schedule_time) {
          return;
        }

        $start = new Carbon($schedule_time);

        if (!$this->scheduleService->isAvailableInterval($date, $doctorId, $start)) {
          $validator->errors()->add('available_time','La hora seleccionada ya se encuentra reservada por otro paciente.');
        }
      });
    }
}
