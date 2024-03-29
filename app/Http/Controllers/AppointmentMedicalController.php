<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointment;
use App\Interfaces\ScheduleServiceInterface;
use App\Models\AppointmentMedical;
use App\Models\Specialty;
// use App\Models\CancelledAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class AppointmentMedicalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexDoctor()
    {

        Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');

        // $pendingAppointments = AppointmentMedical::where('status', 'LIKE','%Reservada%')
        // ->where('doctor_id', auth()->id())
        // ->paginate(10);
        // $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
        // ->where('doctor_id', auth()->id())
        // ->paginate(10);
        // $oldAppointments = AppointmentMedical::whereIn('status', ['Atendida', 'Cancelada'])
        // ->where('doctor_id', auth()->id())
        // ->paginate(10);

        session(['url' => 'doctor']);

        // return dd($role);     
        return view('appointments.index');
    }

    public function indexPatient()
    {

        Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');

        // $pendingAppointments = AppointmentMedical::where('status', 'LIKE','%Reservada%')
        // ->where('patient_id', auth()->id())
        // ->paginate(10);
        // $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
        // ->where('patient_id', auth()->id())
        // ->paginate(10);
        // $oldAppointments = AppointmentMedical::whereIn('status', ['Atendida', 'Cancelada'])
        // ->where('patient_id', auth()->id())
        // ->paginate(10);

        session(['url' => 'patient']);

        return view('appointments.index');

    }

    public function indexPendingAppointments()
    {

        // $pendingAppointments = '';
        // return  response()->json($request->url());
        //
        // if ($request->is('appointment_medicals_doctor')) {
        //   $pendingAppointments = '2';
        //   return $pendingAppointments;
        //
        //
        // }elseif ($request->is('appointment_medicals_patient')) {
        //
        // }

        if (session('url') == 'doctor') {

            Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');
            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');
            $value_one = 'patient_id';
            $value_two = 'doctor';

        }

        // $pendingAppointments = AppointmentMedical::where('status', 'LIKE','%Reservada%')
        // ->where('doctor_id', auth()->id())
        // ->with(['doctor.person:user_id,id,name','specialty:id,name'])->get();

        // $pendingAppointments = AppointmentMedical::where('status', 'LIKE','%Reservada%')
        // ->where('doctor_id', auth()->id())
        // ->with(['doctor.person' => function ($query){
        //   $query->select(['user_id','id', 'name']);
        // }
        // ,'specialty:id,name'])->get();

        $pendingAppointments = AppointmentMedical::where('status', 'LIKE', '%Reservada%')
            ->where($value_one, auth()->id())
            ->with([$value_two => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id', 'id', 'name']);
                },
                ]);
            }
                , 'specialty:id,name'])->get();

        return response()->json($pendingAppointments);

        // DESDE AQUI EMPIEZA LA CANCELACION DE LAS CITAS QUE NO HAN SIDO CANCELADAS
        // $time_now = Carbon::now()->toDateString();
        // // $time_get = Carbon::parse('2021-07-19 17:14:58')->toDateString();
        //
        // $lateAppointments = AppointmentMedical::where('status', 'LIKE','%Reservada%')
        // ->where('doctor_id', auth()->id())->where('schedule_date', '<', $time_now)
        // ->get();
        //
        // if($lateAppointments){
        //   foreach ($lateAppointments as $key => $value) {
        //       $updatelateAppointments = AppointmentMedical::find($lateAppointments[$key]->id);
        //       $updatelateAppointments->status = "Cancelada";
        //       $updatelateAppointments->cancellation_justification = "Cita Cancelada por el Sistema";
        //       $updatelateAppointments->cancelled_by_id = auth()->id();
        //       $updatelateAppointments->update();
        //       //return $lateAppointments[$key]->created_at;
        //
        //   }
        //   //return $updatelateAppointments;
        // }

        // return dd($role);

    }

    public function indexConfirmedAppointments()
    {

        if (session('url') == 'doctor') {

            Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');
            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');
            $value_one = 'patient_id';
            $value_two = 'doctor';

        }

        $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
            ->where($value_one, auth()->id())
            ->with([$value_two => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id', 'id', 'name']);
                },
                ]);
            }
                , 'specialty:id,name'])->get();

        return response()->json($confirmedAppointments);
    }

    public function indexOldAppointments()
    {

        if (session('url') == 'doctor') {

            Gate::authorize('haveaccess', 'appointmentmedicalDoctor.index');
            $value_one = 'doctor_id';
            $value_two = 'patient';

        } elseif (session('url') == 'patient') {

            Gate::authorize('haveaccess', 'appointmentmedicalPatient.index');
            $value_one = 'patient_id';
            $value_two = 'doctor';

        }

        $oldAppointments = AppointmentMedical::whereIn('status', ['Atendida', 'Cancelada'])
            ->where($value_one, auth()->id())
            ->with([$value_two => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id', 'id', 'name']);
                },
                ]);
            }
            , 'cancelletion_by' => function ($query) {
                $query->select(['id'])->with(['person' => function ($query) {
                    $query->select(['user_id','id', 'name', 'lastname']);
                },
                ]);
             }
             , 'specialty:id,name'])->get();

        return response()->json($oldAppointments);
    }

    // public function create(ScheduleServiceInterface $scheduleService)
    public function create()
    {

        Gate::authorize('haveaccess', 'appointmentmedical.create');

        // Todo Esta parte de aqui, funciona con blade y no con javascript.
        // Todo Por lo tanto hay que comentarlo y solo enviar el create.blade.php de appointmentmedical.

        // $specialties = Specialty::all();

        // ! Esta parte de aqui no funciona porque no tengo los valores que se envian en la variable doctor name y lastname no estan en la tabla users.
        
        /*$specialtyId = old('specialty_id');
        if ($specialtyId) {
        $specialty = Specialty::find($specialtyId);
        $doctors = $specialty->users;
        }else{
        $doctors = collect();
        }*/

        // ! Hasta Aqui.

        /* $date = old('schedule_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        } */

        // Todo Hasta Aqui.

        // return view('appointments.create', compact('specialties', 'intervals'));
        return view('appointments.create');
    }

    // public function test(ScheduleServiceInterface $scheduleService)
    // {
    //
    //   Gate::authorize('haveaccess','appointmentmedical.create');
    //
    //   $specialties = Specialty::all();
    //   //Esta parte de aqui no funciona porque no tengo los valores que se envian en la variable doctor name y lastname no estan en la tabla users.
    //   /*$specialtyId = old('specialty_id');
    //   if ($specialtyId) {
    //     $specialty = Specialty::find($specialtyId);
    //     $doctors = $specialty->users;
    //   }else{
    //     $doctors = collect();
    //   }*/
    //
    //   $date = old('schedule_date');
    //   $doctorId = old('doctor_id');
    //   if ($date && $doctorId) {
    //     $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);;
    //   }else{
    //     $intervals = null;
    //   }
    //
    //
    //   return view('appointments.create', compact('specialties','intervals'));
    // }

    public function store(StoreAppointment $request)
    {
        //Validaciones a nivel de Servidor
        // $rules = [
        //   'description' => 'required',
        //   'specialty_id' => 'exists:specialties,id',
        //   'doctor_id' => 'exists:users,id',
        //   'schedule_time' => 'required'
        // ];
        //
        // $messages = [
        //   'schedule_time.required' => 'Por favor seleccione una hora valida para su cita.'
        // ];
        //
        // $validator = Validator::make($request->all(), $rules, $messages);
        //
        // $validator->after(function ($validator) use ($request, $scheduleService) {
        //   $date = $request->input('schedule_date');
        //   $doctorId = $request->input('doctor_id');
        //   $schedule_time = $request->input('schedule_time');
        //   if (!$date || !$doctorId  || !$schedule_time) {
        //     return;
        //   }
        //
        //   $start = new Carbon($schedule_time);
        //
        //   if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
        //     $validator->errors()->add('available_time','La hora seleccionada ya se encuentra reservada por otro paciente.');
        //   }
        // });
        //
        // if ($validator->fails()) { // Verificamos que si el validator falla returne con los errores del validator y los datos de los input se mantengan y se han enviados al helper old
        //   return back()
        //   ->withErrors($validator)
        //   ->withInput();
        // }
        //
        // // Guardar una cita
        // $data = $request->only([
        //     'description',
        //     'specialty_id',
        //     'doctor_id',
        //     'schedule_date',
        //     'schedule_time',
        //     'type'
        // ]);
        // $data['patient_id'] = auth()->id();
        //
        // $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']); // Este fomato estaba en 12 horas
        // $data['schedule_time'] = $carbonTime->format('H:i:s'); // Y lo pasamos a 24 horas
        // // //return dd($data);
        //
        // Appointment::create($data);

        //return $request;

        $created = AppointmentMedical::createForPatient($request, auth()->user()->id);

        if ($created) {
            $success = "La cita se ha registrado correctamente.";
        } else {
            $warning = "Ocurrio un problema al registrar la cita médica";
        }

        // Notificacion de que se ha creado la cita correctamente
        // $notification = "La cita se ha registrado correctamente.";

        return redirect('/appointment_medicals/create')->with(compact('success', 'warning'));

        // return back()->with(compact('notification'));
        // Return back es lo mismo que el redirect sino que aqui no especificamos la ruta, laravel ya hace eso por nosotros
        //Este es el que estaba antes return redirect('/appointments');
    }

    public function showCancelForm(AppointmentMedical $appointment)
    {

        Gate::authorize('haveaccess', 'appointmentmedical.showCancelForm');

        if ($appointment->status == 'Confirmada') {
            $role = session('url');
            if (!$role) {
                return redirect()->back();
            }
            $date_reservation = $appointment->schedule_date;
            $appointment_reservation = Carbon::parse($date_reservation)->locale('es')
            ->settings(['formatFunction' => 'isoFormat'])
            ->format('dddd, D [de] MMMM [del] YYYY');
            
            return view('appointments.cancel', compact('appointment', 'role', 'appointment_reservation'));
        }
        // return redirect('/appointmentmedicals');
        return redirect()->back();
    }

    public function postCancel(AppointmentMedical $appointment, Request $request)
    {
        // if ($request->has('justification')){
        //   $cancellation = new CancelledAppointment();
        //   $cancellation->justification = $request->input('justification');
        //   $cancellation->cancelled_by_id = auth()->id();
        //
        //   $appointment->cancellation()->save($cancellation);
        // }
        
        Gate::authorize('haveaccess', 'appointmentmedical.showCancelForm');

        if ($request->has('justification')) {
            $appointment->cancellation_justification = $request->input('justification');
            $appointment->cancelled_by_id = auth()->id();
        }

        $appointment->status = 'Cancelada';
        $saved = $appointment->save(); // update

        if ($saved) {
            $appointment->patient->sendFCM('Su cita ha sido cancelada.');
        }

        if (session('url') == 'doctor') {

            return redirect('/appointment_medicals_doctor');

        }elseif(session('url') == 'patient'){
            
            return redirect('/appointment_medicals_patient');

        }

        // $notification = "La cita se ha cancelado correctamente.";
        // return redirect('/appointment_medicals_patient')->with(compact('notification'));
    }

    public function postConfirm(AppointmentMedical $appointment)
    {

        Gate::authorize('haveaccess', 'appointmentmedical.postConfirm');

        $appointment->status = 'Confirmada';
        $saved = $appointment->save(); // update

        if ($saved) {
            $appointment->patient->sendFCM('Su cita ha sido confirmada.');
        }

        // $notification = "La cita se ha confirmado correctamente.";
        // return redirect('/appointment_medicals_doctor')->with(compact('notification'));
    }

    public function postAttend(AppointmentMedical $appointment)
    {
        
        // TODO Verificar si es necesario colocar una politica para marcar una cita como atendida.
        Gate::authorize('haveaccess', 'appointmentmedical.postConfirm'); 

        $appointment->status = 'Atendida';
        $saved = $appointment->save(); // update

        // $notification = "La cita se ha atendido correctamente.";
        // return redirect('/appointment_medicals_doctor')->with(compact('notification'));
    }

    /* public function show(AppointmentMedical $appointment) // YA NO FUNCIONARIA PORQUE YA ES REACTIVO CON VUE
    {

        Gate::authorize('haveaccess', 'appointmentmedical.show');

        $role = auth()->user()->roles()->first()->name;
        return view('appointments.show', compact('appointment', 'role'));
        //return dd($appointment);
    }

    public function showDoctor(AppointmentMedical $appointment) // YA NO FUNCIONARIA PORQUE YA ES REACTIVO CON VUE
    {

        Gate::authorize('haveaccessshowAppointmentMedical', [$appointment, ['appointmentmedical.show', 'patient.create']]);
        $role = 'Doctor';
        // Gate::authorize('haveaccess','appointmentmedical.show');

        // $role = auth()->user()->rols()->first()->name;
        return view('appointments.show', compact('appointment', 'role'));
        //return dd($appointment);
    }

    public function showDoctorJson(AppointmentMedical $appointment) // YA NO FUNCIONARIA PORQUE YA ES REACTIVO CON VUE
    {

        Gate::authorize('haveaccessshowAppointmentMedical', [$appointment, ['appointmentmedical.show', 'patient.create']]);
        $role = 'Doctor';
        // Gate::authorize('haveaccess','appointmentmedical.show');

        // $role = auth()->user()->rols()->first()->name;
        return view('appointments.show', compact('appointment', 'role'));
        //return dd($appointment);
    }

    public function showPatient(AppointmentMedical $appointment) // YA NO FUNCIONARIA PORQUE YA ES REACTIVO CON VUE
    {

        Gate::authorize('haveaccessshowAppointmentMedical', [$appointment, ['appointmentmedical.show', 'appointmentmedical.create']]);
        $role = 'Paciente';

        return view('appointments.show', compact('appointment', 'role'));
        //return dd($appointment);
    } */

    public function pendingAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            Gate::authorize('haveaccess', 'patient.dashboard');

            $pendingAppointments = AppointmentMedical::where('status', 'Reservada')
                ->where('patient_id', auth()->id())->count();
            return response()->json($pendingAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            Gate::authorize('haveaccess', 'doctor.dashboard');

            $pendingAppointments = AppointmentMedical::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($pendingAppointments);

        }
    }

    public function confirmedAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            Gate::authorize('haveaccess', 'patient.dashboard');

            $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())->count();
            return response()->json($confirmedAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            Gate::authorize('haveaccess', 'doctor.dashboard');

            $confirmedAppointments = AppointmentMedical::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($confirmedAppointments);

        }
    }

    public function attendedAppointments(Request $request)
    {

        if ($request->ajax() && $request->role == 'patient') {

            Gate::authorize('haveaccess', 'patient.dashboard');

            $attendedAppointments = AppointmentMedical::where('status', 'Atendida')
                ->where('patient_id', auth()->id())->count();
            return response()->json($attendedAppointments);

        }elseif($request->ajax() && $request->role == 'doctor'){

            Gate::authorize('haveaccess', 'doctor.dashboard');

            $attendedAppointments = AppointmentMedical::where('status', 'Atendida')
                ->where('doctor_id', auth()->id())->count();
            return response()->json($attendedAppointments);

        }

    }
}
