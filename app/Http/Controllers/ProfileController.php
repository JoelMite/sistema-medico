<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfileController extends Controller
{
  public function __construct(){
   $this->middleware('auth');
  }

  public function show(){

    Gate::authorize('haveaccess','profile.show');

    $user = auth()->user();
    $date_b = $user->person->date_birth;
    $date_birth = Carbon::parse($date_b)->locale('es')->settings(['formatFunction' => 'isoFormat'])->format('LL');

    //return dd($user);

    return view('profile.index', compact('user', 'date_birth'));
  }

}
