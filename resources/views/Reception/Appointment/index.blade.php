@extends('Layouts.FrontEnd.layout')

@section('title')
    Today's Appointments
@endsection

@section('content')
<div class="home-mid mt-5">
    <h1 class="mb-5 w-100 text-align-left">Today's Appointments</h1>
    <div class="input-group rounded mb-3">
        <input id="search" type="search" class="form-control rounded" placeholder="Search by Patient Name" aria-label="Search" aria-describedby="search-addon" />
    </div>
    <table id="table" class="table" style="border-color: rgb(0, 48, 89)">
    @if (!$appointments->isEmpty())
        <thead>
            <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Doctor Name</th>
                <th class="text-center" scope="col">Patient Name</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Slot</th>
                <th class="text-center" scope="col">More</th>
            </tr>
        </thead>
        <tbody>
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

                if (($now > $end_time && $app->status != AppStatus::CANCELLED) || ($now > $start_time && $app->is_paid == 0))
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
            <tr>
                <td class="text-center">{{ $app->id }}</td>
                <td class="text-center">{{ $app->doctor->name }}</td>
                <td class="text-center">{{ $app->patient->name }}</td>
                <td class="text-center {{ $app->status == AppStatus::PENDING || $app->status == AppStatus::ONGOING ? 'text-warning' : ( $app->status == AppStatus::COMPLETE ? 'text-success' : 'text-danger' ) }}">{{ $app->status }}</td>
                <td class="text-center">{{ $app->time }}</td>
                <td class="text-end">
                    @if ($app->status == AppStatus::PENDING && $app->is_paid == 0)
                        <a href="{{ route('reception.payment', ['appointment' => $app]) }}" class="btn btn-primary">Recieve Payment</a>
                        <a href="{{ route('reception.cancel' , ['appointment' => $app]) }}" class="btn btn-danger">Cancel</a>
                    @endif
                </td>
            </tr>
            @endforeach
    @else
        <h1 class="text-center">You have no Appointments Today</h1>
    @endif

</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        let rows = $('#table tbody tr');

        $('#search').keyup(function() {
            let val = $('#search').val();

            rows.each(function (index, apt) {
                let row = $(apt);
                let text = $(row.children()[2]).text();

                if (text.toUpperCase().indexOf(val.toUpperCase()) > -1) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        });
    });
</script>
@endsection
