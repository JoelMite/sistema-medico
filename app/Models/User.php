<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPassword;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'creator_id', //Aqui hay un error (name)
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot', 'email_verified_at', 'created_at', 'updated_at', // Le oculte la tabla pivot para solo traer datos relacionados al usuario
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function persons(){
      return $this->hasOne(Person::class);
    }

    public function rols(){
      return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function specialties(){
      return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    public function asDoctorAppointments(){
      return $this->hasMany(Appointment::class, 'doctor_id'); // Esto practiamente no funcionaria porque es algo que he omitido
    }

    public function asPatientAppointments(){
      return $this->hasMany(Appointment::class, 'patient_id'); // Esto practiamente no funcionaria porque es algo que he omitido
    }

    public function attendedAppointments(){
      return $this->asDoctorAppointments()->where('status', 'Atendida'); // Esto practiamente no funcionaria porque es algo que he omitido
    }

    public function cancelledAppointments(){
      return $this->asDoctorAppointments()->where('status', 'Cancelada'); // Esto practiamente no funcionaria porque es algo que he omitido
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }

    public function sendFCM($message)
    {
      return fcm()
      ->to([$this->device_token])
      ->notification([
        'title' => config('app.name'),
        'body' => $message
      ])
      ->send();
    }


}
