<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //permission history clinic
      $permission = Permission::create([
          'name' => 'Listar Historias Clínicas',
          'slug' => 'historyclinic.index',
          'description' => 'El usuario puede listar las historias clínicas.',
      ]);

      $permission = Permission::create([
          'name' => 'Ver Historias Clínicas',
          'slug' => 'historyclinic.show',
          'description' => 'El usuario puede ver la info de las historias clínicas.',
      ]);

      $permission = Permission::create([
          'name' => 'Crear Historia Clínica',
          'slug' => 'historyclinic.create',
          'description' => 'El usuario puede crear una historia clínica.',
      ]);

      $permission = Permission::create([
          'name' => 'Editar Historia Clínica',
          'slug' => 'historyclinic.edit',
          'description' => 'El usuario puede editar la info de una historia clínica.',
      ]);

      // $permission = Permission::create([
      //     'name' => 'Destroy role',
      //     'slug' => 'role.destroy',
      //     'description' => 'A user can destroy role',
      // ]);
      //
      // $permission_all[] = $permission->id;


      //permission medical consultation
      $permission = Permission::create([
          'name' => 'Listar Pacientes con Consultas Médicas',
          'slug' => 'medicalconsultation.index',
          'description' => 'El usuario puede listar a las personas que pueden acceder a una consulta médica.',
      ]);

      // Agregado

      $permission = Permission::create([
          'name' => 'Listar Consultas Médicas',
          'slug' => 'medicalconsultation.indexShow',
          'description' => 'El usuario puede listar las consultas médicas que han sido creadas.',
      ]);

      //

      $permission = Permission::create([
          'name' => 'Mostrar Consultas Médicas',
          'slug' => 'medicalconsultation.show',
          'description' => 'El usuario puede ver la info de las consultas médicas.',
      ]);

      $permission = Permission::create([
          'name' => 'Crear Consulta Médica',
          'slug' => 'medicalconsultation.create',
          'description' => 'El usuario puede crear una consulta médica.',
      ]);

      $permission = Permission::create([
          'name' => 'Editar Consulta Médica',
          'slug' => 'medicalconsultation.edit',
          'description' => 'El usuario puede editar la info de una consulta médica.',
      ]);


      //permission schedule attention
      $permission = Permission::create([
          'name' => 'Gestionar Horario',
          'slug' => 'schedule.edit',
          'description' => 'El usuario puede gestionar su horario de atención.',
      ]);


      //permission appointment
      $permission = Permission::create([
          'name' => 'Listar Citas Médicas (Doctor)',
          'slug' => 'appointmentmedicalDoctor.index',
          'description' => 'El usuario puede listar el historial de todas sus citas médicas.',
      ]);

      $permission = Permission::create([
          'name' => 'Listar Citas Médicas (Paciente)',
          'slug' => 'appointmentmedicalPatient.index',
          'description' => 'El usuario puede listar el historial de todas sus citas médicas.',
      ]);

      $permission = Permission::create([
          'name' => 'Cancelar Cita Médica',
          'slug' => 'appointmentmedical.showCancelForm',
          'description' => 'El usuario puede cancelar una cita médica.',
      ]);

      $permission = Permission::create([
          'name' => 'Mostrar Cita Médica',
          'slug' => 'appointmentmedical.show',
          'description' => 'El usuario puede ver la info de las citas médicas.',
      ]);

      $permission = Permission::create([
          'name' => 'Confirmar Cita Médica',
          'slug' => 'appointmentmedical.postConfirm',
          'description' => 'El usuario puede confirmar la atención de una cita médica.',
      ]);


      //permission user doctor
      $permission = Permission::create([
          'name' => 'Listar Médicos',
          'slug' => 'doctor.index',
          'description' => 'El usuario puede listar los médicos.',
      ]);

      $permission = Permission::create([
          'name' => 'Ver Médicos',
          'slug' => 'doctor.show',
          'description' => 'El usuario puede ver la info de los médicos.',
      ]);

      $permission = Permission::create([
          'name' => 'Crear Médico',
          'slug' => 'doctor.create',
          'description' => 'El usuario puede crear un médico.',
      ]);

      $permission = Permission::create([
          'name' => 'Editar Médico',
          'slug' => 'doctor.edit',
          'description' => 'El usuario puede editar la info de un médico.',
      ]);


      //permission user patient
      $permission = Permission::create([
          'name' => 'Listar Pacientes',
          'slug' => 'patient.index',
          'description' => 'El usuario puede listar los pacientes.',
      ]);

      $permission = Permission::create([
          'name' => 'Ver Pacientes',
          'slug' => 'patient.show',
          'description' => 'El usuario puede ver la info de los pacientes.',
      ]);

      $permission = Permission::create([
          'name' => 'Crear Paciente',
          'slug' => 'patient.create',
          'description' => 'El usuario puede crear un paciente.',
      ]);

      $permission = Permission::create([
          'name' => 'Editar Paciente',
          'slug' => 'patient.edit',
          'description' => 'El usuario puede editar la info de un paciente .',
      ]);


      //permission profile
      $permission = Permission::create([
          'name' => 'Ver Perfil',
          'slug' => 'profile.show',
          'description' => 'El usuario puede ver su perfil.',
      ]);


      //permission role
      $permission = Permission::create([
          'name' => 'Listar Roles',
          'slug' => 'role.index',
          'description' => 'El usuario puede listar los roles.',
      ]);

      $permission = Permission::create([
          'name' => 'Ver Roles',
          'slug' => 'role.show',
          'description' => 'El usuario puede ver la info de los roles.',
      ]);

      $permission = Permission::create([
          'name' => 'Crear Rol',
          'slug' => 'role.create',
          'description' => 'El usuario puede crear un rol.',
      ]);

      $permission = Permission::create([
          'name' => 'Editar Rol',
          'slug' => 'role.edit',
          'description' => 'El usuario puede editar la info de un rol.',
      ]);


      //permission specialty
      $permission = Permission::create([
          'name' => 'Listar Especialidades',
          'slug' => 'specialty.index',
          'description' => 'El usuario puede listar las especialidades.',
      ]);

      $permission = Permission::create([
          'name' => 'Ver Especialidades',
          'slug' => 'specialty.show',
          'description' => 'El usuario puede ver la info de las especialidades.',
      ]);

      $permission = Permission::create([
          'name' => 'Crear Especialidad',
          'slug' => 'specialty.create',
          'description' => 'El usuario puede crear una especialidad.',
      ]);

      $permission = Permission::create([
          'name' => 'Editar Especialidad',
          'slug' => 'specialty.edit',
          'description' => 'El usuario puede editar la info de una especialidad.',
      ]);


      //permission banned user
      $permission = Permission::create([
          'name' => 'Activar Usuario',
          'slug' => 'user.state',
          'description' => 'El usuario puede activar la cuenta de una persona.',
      ]);


      //permission active user
      $permission = Permission::create([
          'name' => 'Banear Usuario',
          'slug' => 'user.state',
          'description' => 'El usuario puede banear la cuenta de una persona.',
      ]);


      //permission appointment
      $permission = Permission::create([
          'name' => 'Crear Cita Médica',
          'slug' => 'appointmentmedical.create',
          'description' => 'El usuario puede crear una cita médica.',
      ]);


      // Agregado
      //permission dashboard administrator
      $permission = Permission::create([
          'name' => 'Dashboard Administrador',
          'slug' => 'administrator.dashboard',
          'description' => 'El usuario puede ver un resumen de su actividad como administrador.',
      ]);

      // Agregado
      //permission dashboard doctor
      $permission = Permission::create([
          'name' => 'Dashboard Médico',
          'slug' => 'doctor.dashboard',
          'description' => 'El usuario puede ver un resumen de su actividad como médico.',
      ]);


    }
}
