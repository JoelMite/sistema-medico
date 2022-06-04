<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FirebaseController extends Controller
{
    public function sendAll(Request $request){

      //dd($request->all());

      $recipients = User::whereNotNull('device_token')->pluck('device_token')->toArray();

      // $data = env('DB_USERNAME');
      // return $data;

      // $url = "https://fcm.googleapis.com/fcm/send";
      // $header = [
      // 'authorization: key=AAAAQPDeLdI:APA91bEaw4vpj49MGZgfaRobvMpnEtrjRq_w6d4lSA6UnwYVYYElnRTxdlqk-Dzhd2ZtbQvekKXQOSjT9-GNdVcHrHlAhyiFe-nq-EEYZ5UlgneyJKHwKn1BcvW2VjUBz4XQf3hAMze8',
      //     'content-type: application/json'
      // ];
      //
      // $postdata = '{
      //     "to" : "",
      //         "notification" : {
      //             "title":"' . $request->input('title') . '",
      //             "text" : "' . $request->input('body') . '"
      //         },
      //     "data" : {
      //         "id" : "4",
      //         "title":"Hola",
      //         "description" : "Como estas",
      //         "text" : "Bien",
      //         "is_read": 0
      //       }
      // }';
      //
      // $ch = curl_init();
      // curl_setopt($ch, CURLOPT_URL, $url);
      // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
      // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      // curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
      // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      //
      // $result = curl_exec($ch);
      // curl_close($ch);
      // return $result;

      $recipients = User::whereNotNull('device_token')
      ->where('creator_id', '=', auth()->id())
      ->whereHas('roles', function($query){
        $query->whereHas('permissions', function($query){
          $query->where('name','=','Crear Cita Médica');
        });
      })
      ->pluck('device_token')->toArray();
      
        fcm()
        ->to($recipients)
        ->notification([
          'title' => $request->input('title'),
          'body' => $request->input('body')
        ])
        ->send();

        // return $recipients;

        $success = 'Notificación enviada a todos mis pacientes (Android).';
        return back()->with(compact('success'));
    }
}
