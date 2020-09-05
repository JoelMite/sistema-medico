<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\user;

class CancelledAppointment extends Model
{
  public function cancelled_by() // Laravel busca un campo parecido al metodo con el sufijo final _id (cancelled_by_id)
  {
    // Cancellation N - 1 User
    return $this->belongsTo(User::class);
  }
}
