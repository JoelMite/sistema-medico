<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\MedicalConsultation;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function show(MedicalConsultation $medical_consultations){

      Gate::authorize('haveaccess','appointmentmedical.show');

      //return dd($medical_consultations->medical_prescriptions);
      $doctor_id = $medical_consultations->history_clinic->person->user->creator_id;
      $data_doctor = User::findOrfail($doctor_id);
      // foreach($medical_consultations->medical_prescriptions as $medical_prescription){
      //  return dd($medical_consultations);
      // }
      return view('pdf.medical_consultations_pdf', compact('medical_consultations', 'data_doctor'));

      // $pdf = PDF::loadView('invoice');
      // return $pdf->download('invoice.pdf');
    }
    public function export(MedicalConsultation $medical_consultations){

      Gate::authorize('haveaccess','appointmentmedical.show');

      //return dd($medical_consultations->medical_prescriptions);
      $doctor_id = $medical_consultations->history_clinic->person->user->creator_id;
      $data_doctor = User::findOrfail($doctor_id);
      // foreach($medical_consultations->medical_prescriptions as $medical_prescription){
      //  return dd($medical_consultations);
      // }

      $pdf = PDF::loadView('pdf.medical_consultations_export_pdf', compact('medical_consultations', 'data_doctor'));
      //return $pdf->download('medical_consultations_export_pdf.pdf');
      return $pdf->setPaper('a4', 'landscape')->stream('Reporte Médico');

      //return view('pdf.medical_consultations_export_pdf', compact('medical_consultations', 'data_doctor'));

      // $pdf = PDF::loadView('invoice');
      // return $pdf->download('invoice.pdf');
    }
}
