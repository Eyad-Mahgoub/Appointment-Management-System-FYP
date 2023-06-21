@extends('Layouts.FrontEnd.layout')

@section('title')
    Today's Appointments
@endsection

@section('content')
<div class="home-mid mt-5">
    <h1 class="mb-5 w-100 text-align-left">Today's Appointments</h1>
    @if (!$appointments->isEmpty())
        @foreach ($appointments as $app)
        <?php
            $start_time = 0;
            $end_time = 0;
            switch ($app->slot) {
                case 1:
                    $start_time = new DateTime('08:00 AM');
                    $end_time = new DateTime('10:00 AM');
                    break;
                case 2:
                    $start_time = new DateTime('10:00 AM');
                    $end_time = new DateTime('12:00 PM');
                    break;
                case 3:
                    $start_time = new DateTime('12:00 PM');
                    $end_time = new DateTime('02:00 PM');
                    break;
                case 4:
                    $start_time = new DateTime('02:00 PM');
                    $end_time = new DateTime('05:00 PM');
                    break;
            }
            $now = new DateTime(date('h:i A', strtotime('now')));
            // $now = new DateTime('11:00 AM');

            if ($now > $end_time && $app->status == AppStatus::PENDING)
            {
                $app->status = AppStatus::DIDNOTATTEND;
                $app->update();
            }

            if ($now >= $start_time && $now < $end_time && $app->status == AppStatus::PENDING )
            {
                $app->status = AppStatus::ONGOING;
                $app->update();
            }
        ?>
        <div class="card w-100 my-2">
            <div class="card-body d-flex justify-content-between align-items-center ">
                <div class="appointment-info w-40">
                    <h3>Appointment #{{ $app->id }}</h3>
                    <p>
                        <b>Doctor:</b> {{ $app->doctor->name }} <br>
                        <b>Time:</b> {{ $app->time }}
                    </p>
                </div>
                <div class="appointment-status w-20 text-center">

                    <h4 class="{{ $app->status == AppStatus::PENDING || $app->status == AppStatus::ONGOING ? 'text-warning' : ( $app->status == AppStatus::COMPLETE ? 'text-success' : 'text-danger' ) }}">{{ $app->status }}</h4>
                </div>

                @if (($now >= $start_time && $now < $end_time && $app->staus != AppStatus::CANCELLED) || $app->status == AppStatus::COMPLETE)
                <div class="appointment-options w-40 d-flex justify-content-end">
                    <input type="text" class="d-none aptId" id="" value="{{ $app->id }}">
                    @if (!$app->report)
                        <button class="btn btn-primary mx-1 addReport" data-bs-toggle="modal" data-bs-target="#addReport">Add Report</button>
                    @else
                        <button class="btn btn-primary mx-1 editReport" data-bs-toggle="modal" data-bs-target="#editReport">Edit Report</button>
                    @endif

                    @if ($app->perscriptions->isEmpty())
                        <button class="btn btn-primary mx-1 addPerscription" data-bs-toggle="modal" data-bs-target="#addPerscription">Add Perscription</button>
                    @else
                        <button class="btn btn-primary mx-1 addPerscription" data-bs-toggle="modal" data-bs-target="#addPerscription">Edit Perscription</button>
                    @endif

                    @if ($app->report && !$app->perscriptions->isEmpty() && $app->status == AppStatus::ONGOING)
                        <a href="{{ route('doctorApp.conclude', ['appointment' => $app]) }}" class="btn btn-success mx-1">Conclude Appointment</a>
                    @endif
                </div>
                {{-- @elseif ($now < $start_time && ($app->status != AppStatus::CANCELLED && $app->status != AppStatus::COMPLETE))
                <div class="appointment-options w-40 d-flex justify-content-end">
                    <button class="btn btn-danger mx-1">Cancel</button>
                </div> --}}
                @elseif ($now > $end_time && $app->status != AppStatus::DIDNOTATTEND)
                <div class="appointment-options w-40 d-flex justify-content-end">
                    <input type="text" class="d-none aptId" id="" value="{{ $app->id }}">
                    <button class="btn btn-primary mx-1 editReport" data-bs-toggle="modal" data-bs-target="#editReport">Edit Report</button>
                    <button class="btn btn-primary mx-1 addPerscription" data-bs-toggle="modal" data-bs-target="#addPerscription">Edit Perscription</button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @else
        <h1 class="text-center">You have no Appointments Today</h1>
    @endif

</div>

{{-- Add Dr Report --}}

<div class="modal fade" id="addReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('docReport.create') }}" method="POST">
                    @csrf
                    <input type="text" class="addReport-aptId d-none" name="appt_id">
                    <div class="mb-3">
                        <label class="form-label">Diagnosis</label>
                        <textarea class="form-control" name="diagnosis" cols="30" rows="10"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Dr Report --}}

<div class="modal fade" id="editReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="editReportSpinner modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        {{-- <span class="visually-hidden">Loading...</span> --}}
                    </div>
                </div>
            </div>
            <div class="editReportModal" style="display: none;">
                <div class="modal-body">
                    <form action="{{ route('docReport.store') }}" method="POST">
                        @csrf
                        <input type="text" class="editReport-aptId d-none" name="appt_id">
                        <div class="mb-3">
                            <label class="form-label">Diagnosis</label>
                            <textarea class="form-control editReportText" name="diagnosis" cols="30" rows="10"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Perscription --}}

<div class="modal fade" id="addPerscription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Perscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="editPerscriptionSpinner modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        {{-- <span class="visually-hidden">Loading...</span> --}}
                    </div>
                </div>
            </div>
            <div class="editPerscriptionModal" style="display: none;">
                <div class="modal-body addPerscription-details">
                    <table class="perscriptionTable w-100">
                        <thead>
                          <tr>
                            <th scope="col">Medicine</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">More</th>
                          </tr>
                        </thead>
                        <tbody class="perscriptionDetails">

                        </tbody>
                      </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-target="#addMedicine" data-bs-toggle="modal" data-bs-dismiss="modal">Add Medicine</button>
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Medicine --}}

<div class="modal fade" id="addMedicine" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Perscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="editMedicineModal">
                <div class="modal-body addPerscription-details">
                    <form method="post" action="{{ route('perscription.create') }}">
                        @csrf
                        <input type="text" class="addMedicine-aptId d-none" name="appt_id">
                        <div class="mb-3">
                            <label for="" class="form-label">Medicine</label>
                            <select class="form-select" name="medicine_id" aria-label="Default select example">
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Dosage</label>
                            <input type="text" name="dosage" id="" class="form-control">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="submit" class="btn btn-secondary" data-bs-target="#addPerscription" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        // Report Stuff
        $(document).on('click', '.addReport', function () {
            let id = $(this).closest('.appointment-options').find('.aptId').val();
            $('.addReport-aptId').val(id);
            console.log($('.addReport-aptId').val());
        });
        $(document).on('click', '.editReport', function () {
            let id = $(this).closest('.appointment-options').find('.aptId').val();
            $('.editReport-aptId').val(id);
            console.log($('.addReport-aptId').val());

            $(".editReportSpinner").show();
            $(".editReportModal").hide();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/editReport/' + id,
                type: 'post',
                success:  function (response) {
                    console.log(response.diagnosis)
                    $('.editReportText').val(response.diagnosis);
                    $(".editReportSpinner").hide();
                    $(".editReportModal").show(400);
                },
                error: function(x,xs,xt){
                    // alert(x);

                }
            });
        });

        // Perscription Stuff
        $(document).on('click', '.addPerscription', function () {
            let id = $(this).closest('.appointment-options').find('.aptId').val();
            $('.addMedicine-aptId').val(id);

            $(".editPerscriptionSpinner").show();
            $(".editPerscriptionModal").hide();
            $('.perscriptionDetails').empty();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/getPerscriptions/' + id,
                type: 'post',
                success:  function (response) {
                    console.log(response)
                    response.data.forEach(element => {
                        let row = $(`
                        <tr>
                            <td>${element.name}</td>
                            <td>${element.dosage}</td>
                            <td><a href="/deletePerscription/${element.id}" class="btn btn-primary">Delete</a></td>
                        </tr>
                        `);
                        $('.perscriptionDetails').append(row);
                    });
                    $(".editPerscriptionSpinner").hide();
                    $(".editPerscriptionModal").show(400);
                },
                error: function(x,xs,xt){
                    // alert(x);

                }
            });
        });
    });
</script>
@endsection
