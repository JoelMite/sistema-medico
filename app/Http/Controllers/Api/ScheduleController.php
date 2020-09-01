<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function hours(Request $request){

      //dd($request->all());
      $rules = [
          'date' => 'required|date_format:"Y-m-d"',
          'doctor_id' => 'required|exists:users,id'
      ];

      $this->validate($request, $rules);

      $date = $request->input('date');
      $dateCarbon = new Carbon($date);



      $i = $dateCarbon->dayOfWeek;
      $day = ($i==0 ? 6 : $i-1);

      //$day = $dateCarbon->dayOfWeek;
      //dd($day);

      $doctorId = $request->input('doctor_id');

      $workDay = WorkDay::where('active', true)
        ->where('day', $day)
        ->where('user_id', $doctorId)
        ->first([
          'morning_start','morning_end','afternoon_start','afternoon_end'
        ]);

      if(!$workDay){
        return[];
      }

      $morningStart = $workDay->morning_start;
      $morningEnd = $workDay->morning_end;

      $afternoonStart = $workDay->afternoon_start;
      $afternoonEnd = $workDay->afternoon_end;

      $morningIntervals = $this->getIntervals(
        $morningStart, $morningEnd
      );

      $afternoonIntervals = $this->getIntervals(
        $afternoonStart, $afternoonEnd
      );

      // $morningIntervals = [];
      //
      // while ($morningStart < $morningEnd ) {
      //
      //     $interval = [];
      //     $interval ['start'] = $morningStart->format('g:i A');
      //     $morningStart->addMinutes(30);
      //     $interval ['end'] = $morningStart->format('g:i A');;
      //
      //     $morningIntervals [] = $interval;
      //
      // }

      //dd($intervals);

      $data = [];
      $data['morning'] = $morningIntervals;
      $data['afternoon'] = $afternoonIntervals;

      return $data;

        /*$table->unsignedSmallInteger('day');
        $table->boolean('active');

        $table->time('morning_start');
        $table->time('morning_end');

        $table->time('afternoon_start');
        $table->time('afternoon_end');

        $table->unsignedBigInteger('user_id');*/
    }

    private function getIntervals($start, $end){

      $start = new Carbon($start);
      $end = new Carbon($end);

      $intervals = [];

      while ($start < $end ) {

          $interval = [];
          $interval ['start'] = $start->format('g:i A');
          $start->addMinutes(30);
          $interval ['end'] = $start->format('g:i A');;

          $intervals [] = $interval;

      }
      return $intervals;
    }
}
