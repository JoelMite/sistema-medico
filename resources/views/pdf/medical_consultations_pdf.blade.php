<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
    <style>
        .page-break {
            page-break-after: always;
        }
        .bg-grey {
            background: #F3F3F3;
        }
        .text-right {
            text-align: right;
        }
        .w-full {
            width: 100%;
        }
        .small-width {
            width: 15%;
        }
        .invoice {
            background: white;
            border: 1px solid #CCC;
            font-size: 14px;
            padding: 48px;
            margin: 20px 0;
        }
        .box-doctor{
          background-color:#d8ecf7;
	        border:1px solid #afcde3;
          border-radius: 10px;
          -webkit-border-radius: 10px;
          margin:0 0 25px;
        }
        .box-patient{
          background-color:#F8C471;
	        border:1px solid #afcde3;
          border-radius: 10px;
          -webkit-border-radius: 10px;
          margin:0 0 25px;
        }
        .tg-c3ow{
          border-color:inherit;
          text-align:center;
          vertical-align:top
        }
    </style>
</head>
<body class="bg-grey">

  <div class="container container-smaller">
    <div class="row">
      {{-- <div class="col-lg-10 col-lg-offset-1" style="margin-top:20px; text-align: right">
        <div class="btn-group mb-4">
          <a href="/invoice-pdf" class="btn btn-success">Save as PDF</a>
        </div>
      </div> --}}
    </div>
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
          <div class="invoice">
            <div class="row">
              <div class="col-sm-6 box-doctor">
                <h4><strong>Médico: </strong>Dr. {{ $data_doctor->person->name }}</h4>
                <address>
                  <strong>Dirección: </strong>{{ $data_doctor->person->address }}. <br>
                  {{-- Toronto, Ontario - L2R 4U6<br> --}}
                  <strong>Teléfono: </strong>{{ $data_doctor->person->phone }} <br>
                  <strong>Email: </strong>{{ $data_doctor->email }}
                </address>
              </div>

              <div class="col-sm-6 text-right">
                <img src="https://res.cloudinary.com/dqzxpn5db/image/upload/v1537151698/website/logo.png" alt="logo">
              </div>
            </div>

            <div class="row">

              <div class="col-sm-7 box-patient">
                <h4><strong>Paciente: </strong>{{ $medical_consultations->history_clinic->person->lastname }} {{ $medical_consultations->history_clinic->person->name }}</h4>
                <address>
                  <strong>Historia Clínica: </strong>{{ $medical_consultations->history_id }}<br>
                  <strong>C.I.: </strong>{{ $medical_consultations->history_clinic->person->dni }}<br>
                  <strong>Edad: </strong>{{ $medical_consultations->history_clinic->person->age }}<br>
                  <strong>Dirección: </strong>{{ $medical_consultations->history_clinic->person->address }}<br>
                  <strong>Email: </strong>{{ $medical_consultations->history_clinic->person->user->email }}<br>
                  <span> {{ $medical_consultations->history_clinic->person->address }} </span><br>
                  <span> {{ $medical_consultations->history_clinic->person->user->email }} </span>
                </address>
              </div>

              {{-- <div class="col-sm-5 text-right">
                <table class="w-full">
                  <tbody>
                    <tr>
                      <th>Invoice Num:</th>
                      <td>56</td>
                    </tr>
                    <tr>
                      <th> Invoice Date: </th>
                      <td>Jun 24, 2019</td>
                    </tr>
                  </tbody>
                </table>

                <div style="margin-bottom: 0px">&nbsp;</div>

                <table class="w-full">
                  <tbody>
                    <tr class="well" style="padding: 5px">
                      <th style="padding: 5px"><div> Balance Due (CAD) </div></th>
                      <td style="padding: 5px"><strong> $499 </strong></td>
                    </tr>
                  </tbody>
                </table>


              </div> --}}
            </div>

            <div class="table-responsive">
              <table class="table invoice-table">
                <thead style="background: #33DFFF;">
                  <tr>
                    <th>Consulta Médica</th>
                    <th></th>
                    {{-- <th class="text-right">Price</th> --}}
                  </tr>
                </thead>
                <tbody>
                  <tr style="background: #F5F5F5;">
                    <td>
                        <strong>Motivo</strong>
                        <p> {{ $medical_consultations->reason }} </p>
                    </td>
                    <td></td>
                    {{-- <td class="text-right">$600</td> --}}
                  </tr>

                  <tr>
                    <td>
                        <strong>Diagnóstico</strong>
                        <p> {{ $medical_consultations->diagnosis }} </p>
                    </td>
                    <td></td>
                    {{-- <td class="text-right">$600</td> --}}
                  </tr>

                  <tr style="background: #F5F5F5;">
                    <td>
                        <strong>Observaciones</strong>
                        <p> {{ $medical_consultations->observations }} </p>
                    </td>
                    <td></td>
                  </tr>

                  </tbody>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table invoice-table">
                  <thead style="background: #FFBE33;">
                    <tr>
                      <th colspan="5">Signos Vitales</th>
                      {{-- <th class="text-right">Price</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="background: #F5F5F5;">
                      <td class="tg-c3ow"><strong>Presión Arterial</strong></td>
                      <td class="tg-c3ow"><strong>Frecuencia Cardíaca</strong></td>
                      <td class="tg-c3ow"><strong>Frecuencia Respiratoria</strong></td>
                      <td class="tg-c3ow"><strong>Peso</strong></td>
                      <td class="tg-c3ow"><strong>Altura</strong></td>
                    </tr>
                    <tr>
                      <td class="tg-c3ow">18</td>
                      <td class="tg-c3ow">78</td>
                      <td class="tg-c3ow">78</td>
                      <td class="tg-c3ow">87</td>
                      <td class="tg-c3ow">87</td>
                    </tr>
                    <tr style="background: #F5F5F5;">
                      <td class="tg-c3ow"><span><strong>IMC</strong></span></strong></td>
                      <td class="tg-c3ow"><span><strong>Perímetro Abdominal</strong></span></strong></td>
                      <td class="tg-c3ow"><span><strong>Glucemia Capilar</strong></span></strong></td>
                      <td class="tg-c3ow" colspan="2"><span><strong>Temperatura</strong></span></td>
                    </tr>
                    <tr>
                      <td class="tg-c3ow">17</td>
                      <td class="tg-c3ow">188</td>
                      <td class="tg-c3ow">47</td>
                      <td class="tg-c3ow" colspan="2">878</td>
                    </tr>

                    </tbody>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table invoice-table">
                  <thead style="background: #3FE902;">
                    <tr>
                      <th>Prescipción Médica</th>
                      <th></th>
                      {{-- <th class="text-right">Price</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="background: #F5F5F5;">
                      <td>
                          <strong>Descripcion</strong>
                          @foreach ( $medical_consultations->medical_prescriptions as $medical_prescription)
                            <p> {{ $medical_prescription->description }} </p>
                          @endforeach

                      </td>
                      <td></td>
                      {{-- <td class="text-right">$600</td> --}}
                    </tr>

                    <tr>
                      <td>
                          <strong>Posología</strong>
                          @foreach ( $medical_consultations->medical_prescriptions as $medical_prescription)
                            <p> {{ $medical_prescription->posology }} </p>
                          @endforeach
                      </td>
                      <td></td>
                      {{-- <td class="text-right">$600</td> --}}
                    </tr>

                    <tr style="background: #F5F5F5;">
                      <td>
                          <strong>Observaciones</strong>
                          @foreach ( $medical_consultations->medical_prescriptions as $medical_prescription)
                            <p> {{ $medical_prescription->observations_pres }} </p>
                          @endforeach
                      </td>
                      <td></td>
                    </tr>

                    </tbody>
                  </table>
                </div>

              <!-- /table-responsive -->

              {{-- <table class="table invoice-total">
                <tbody>
                  <tr>
                    <td class="text-right"><strong>Balance Due :</strong></td>
                    <td class="text-right small-width">$600</td>
                  </tr>
                </tbody>
              </table> --}}

              <hr>

              <div class="row">
                <div class="col-lg-8">
                  <div class="invbody-terms">
                    Thank you for your business. <br>
                    <br>
                    <h4>Payment Terms and Methods</h4>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium cumque neque velit tenetur pariatur perspiciatis dignissimos corporis laborum doloribus, inventore.
                    </p>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>

  </body>
</html>
