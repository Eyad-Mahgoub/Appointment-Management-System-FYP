@extends('Layouts.FrontEnd.layout')

@section('title')

@endsection

@section('content')
<div class="mt-5 home-mid">
    <h1 class="mb-5 w-100 text-align-left">Your Appointments</h1>

    @if ($appointments)
    @foreach ($appointments as $app)
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
                <h4 class="{{ $app->status == 'pending' ? 'text-warning' : ( $app->status == 'complete' ? 'text-success' : 'text-danger' ) }}">{{ $app->status }}</h4>
            </div>
            <div class="appointment-options w-25 d-flex justify-content-end">
                @if ($app->status == 'pending')
                    <a href="{{ route('booking.cancel', ['app' => $app]) }}" class="mx-1 btn btn-danger">Cancel Appointment</a>
                @elseif ($app->status == 'complete')
                    <button class="mx-1 btn btn-primary">View Perscription</button>
                    <button class="mx-1 btn btn-primary">View Report</button>
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
