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
            // $now = new DateTime(date('h:i A', strtotime('now')));
            $now = new DateTime('03:00 PM');

            if ($now > $end_time && $app->status == 'pending')
            {
                $app->status = 'Did Not Attend';
                $app->update();
            }
        ?>
        <div class="card w-100 my-2">
            <div class="card-body d-flex justify-content-between align-items-center ">
                <div class="appointment-info w-25">
                    <h3>Appointment #{{ $app->id }}</h3>
                    <p>
                        <b>Doctor:</b> {{ $app->doctor->name }} <br>
                        <b>Time:</b> {{ $app->time }}
                    </p>
                </div>
                <div class="appointment-status w-50 text-center">

                    <h4 class="{{ $app->status == 'pending' ? 'text-warning' : ( $app->status == 'complete' ? 'text-success' : 'text-danger' ) }}">{{ $app->status }}</h4>
                </div>

                @if ($now >= $start_time && $now < $end_time && $app->staus != 'cancelled')
                <div class="appointment-options w-25 d-flex justify-content-end">
                    <input type="text" class="d-none aptId" id="" value="{{ $app->id }}">
                    @if (!$app->report)
                        <button class="btn btn-primary mx-1 addReport" data-bs-toggle="modal" data-bs-target="#addReport">Add Report</button>
                    @else
                        <button class="btn btn-primary mx-1 editReport">Edit Report</button>
                    @endif

                    @if (!$app->perscription)
                        <button class="btn btn-primary mx-1 addPerscription">Add Perscription</button>
                    @else
                        <button class="btn btn-primary mx-1 editPerscription">Edit Perscription</button>
                    @endif

                    <button class="btn {{ !$app->report || !$app->perscription ? "btn-secondary" : 'btn-success'}} mx-1" {{ !$app->report || !$app->perscription ? "disabled" : ''}}>Conclude Appointment</button>
                </div>
                @elseif ($now < $start_time && $app->status != 'cancelled')
                <div class="appointment-options w-25 d-flex justify-content-end">
                    <button class="btn btn-danger mx-1">Cancel</button>
                </div>
                @elseif ($now > $end_time && $app->status != 'Did Not Attend')
                <div class="appointment-options w-25 d-flex justify-content-end">
                    <input type="text" class="d-none aptId" id="" value="{{ $app->id }}">
                    <button class="btn btn-primary mx-1">Edit Perscription</button>
                    <button class="btn btn-primary mx-1">Edit Report</button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @else
        <h1 class="text-center">You have no Appointments Today</h1>
    @endif

</div>

<div class="modal fade" id="addReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('docReport.create') }}" method="POST">
                    @csrf
                    <input type="text" class="addReport-aptId d-none" name="appt_id">
                    <div class="mb-3">
                        <label class="form-label">Diagnosis address</label>
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
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $(document).on('click', '.addReport', function () {
            let id = $(this).closest('.appointment-options').find('.aptId').val();
            $('.addReport-aptId').val(id);
            console.log($('.addReport-aptId').val());
        });
    });
</script>
@endsection
