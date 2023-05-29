@extends('Layouts.FrontEnd.layout')

@section('title')
    Today's Appointments
@endsection

@section('content')
<div class="home-mid mt-5">
    <h1 class="mb-5 w-100 text-align-left">Today's Appointments</h1>
    @if (!$appointments->isEmpty())
        @foreach ($appointments as $app)
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
                    // date('h:i A', strtotime('now'))
                    $now = new DateTime('10:05 AM');
                ?>
                @if ($now >= $start_time && $now < $end_time)
                <div class="appointment-options w-25 d-flex justify-content-end">
                    <button class="btn btn-primary mx-1">Add Perscription</button>
                    <button class="btn btn-primary mx-1">Add Report</button>
                </div>
                @elseif ($now < $start_time)
                <div class="appointment-options w-25 d-flex justify-content-end">
                    <button class="btn btn-danger mx-1">Cancel</button>
                </div>
                @elseif ($now > $end_time)
                <div class="appointment-options w-25 d-flex justify-content-end">
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
@endsection

@section('script')
@endsection
