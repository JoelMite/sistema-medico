<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalConsultation;
use App\Models\User;

class PdfController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function show(MedicalConsultation $medical_consultations){

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
}
