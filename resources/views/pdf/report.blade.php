@extends('Layouts.pdf.layout')

@section('content')

<div class="norm-mid mt-5 justif-content-start">
    <h1 class="">Doctor's Report</h1>
    <div class="line-dark-25 mb-5"></div>

    <h5><b>Appointment No:</b> {{ $app->id }}</h5>
    <h5><b>DateTime:</b> {{ $app->date }}, {{ $app->time }}</h5>
    <h5 class="mb-5"><b>Doctor:</b> {{ $app->doctor->name }}</h5>

    <h2 class="mt-5">Diagnosis</h2>
    <p>{{ $app->report->diagnosis }}</p>
</div>
@endsection
