@extends('Layouts.FrontEnd.layout')

@section('title')
    My Appointments
@endsection

@section('content')
<div class="mt-5 home-mid">
    <h1 class="mb-5 w-100 text-align-left">Your Appointments</h1>

    @if ($appointments)
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

        if ($now >= $start_time && $now < $end_time && $app->staus == AppStatus::PENDING )
        {
            $app->status = AppStatus::ONGOING;
            $app->update();
        }
    ?>
    <div class="card w-100 my-2">
        <div class="card-body d-flex justify-content-between align-items-center ">
            <div class="appointment-info w-25">
                <h3>Appointment #{{ $app->id }}</h3>
                <p>
                    <b>Doctor:</b> {{ $app->doctor->name }} <br>
                    <b>Date:</b> {{ $app->day }} <br>
                    <b>Time:</b> {{ $app->time }}
                </p>
            </div>
            <div class="appointment-status w-50 text-center">
                <h4 class="{{ $app->status == AppStatus::PENDING || $app->status == AppStatus::ONGOING ? 'text-warning' : ( $app->status == AppStatus::COMPLETE ? 'text-success' : 'text-danger' ) }}">{{ $app->status }}</h4>
            </div>
            <div class="appointment-options w-25 d-flex justify-content-end">
                @if ($app->status == AppStatus::PENDING)
                    <a href="{{ route('booking.cancel', ['app' => $app]) }}" class="mx-1 btn btn-danger">Cancel Appointment</a>
                @elseif ($app->status == AppStatus::COMPLETE)
                    <a href="{{ route('perscription.download', ['app' => $app]) }}" class="mx-1 btn btn-primary">View Perscription</a>
                    <a href="{{ route('docRep.download', ['app' => $app]) }}" class="mx-1 btn btn-primary">View Report</a>
                @else
                @endif
            </div>
        </div>
    </div>
    @endforeach
    @else
        <h1 class="text-center">You have not Booked an Appointment Yet</h1>
        <a href="route('booking.index')" class="btn btn-primary">Book An Appointment</a>
    @endif


</div>
@endsection


@section('script')
@if (session('fail'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "{{ session('fail') }}",
    });
</script>
@endif
@if (session('success'))
<script>
    Swal.fire({
        icon: 'Success',
        title: 'Success',
        text: 'Appointment Cancelled',
    });
</script>
@endif
@endsection
