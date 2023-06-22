@extends('Layouts.FrontEnd.layout')

@section('title')
    Book an Appointment
@endsection

@section('content')
<div class="home-mid mt-5">
    <div class="d-flex w-100 align-items-end">
        <h1 class="me-3  text-align-left">Appointment Booking</h1>

        <p>(All Appointments are SAR 100)</p>
    </div>

    <div class="booking-speciality my-5 row" >
        <h3 class="mb-5 w-100 text-align-left">Select Speciality</h3>
        @foreach ($specs as $spec)
        <div class="spec-data card col-md-4 col-lg-3 col-sm-6 mb-2">
            <div class="d-none spec-id">{{ $spec->id }}</div>
            <div class="card-body">
                <div class="card-title">
                    {{ $spec->name }}
                </div>
                <p class="card-text">
                    {{ $spec->short_description }}
                </p>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <button class="spec-btn w-75 btn btn-primary">Select</button>
            </div>
        </div>
        @endforeach
    </div>

    <div class="booking-doctor my-5 row w-100" style="display: none;">
        <div class="col-10">
            <h3 class="booking-spec-doc mb-5 text-align-left col-10"></h3>
        </div>
        <div class="col-2">
            <button class="w-100 btn btn-primary booking-doctor-back">Back</button>
        </div>
        <div class="row booking-doctor-child">
            {{-- TODO --}}
        </div>
    </div>

    <div class="booking-loading mt-5" style="display: none;">
        <div class="spinner-grow text-primary me-3" role="status"></div>
        <div class="spinner-grow text-primary me-3" role="status"></div>
        <div class="spinner-grow text-primary" role="status"></div>
    </div>

    <div class="booking-day my-5 row w-100" style="display: none;">
        <div class="col-10">
            <h3 class="booking-doc-day mb-5 text-align-left col-10">Select A Day</h3>
        </div>
        <div class="col-2">
            <button class="w-100 btn btn-primary booking-day-back">Back</button>
        </div>
        <div class="row booking-day-child">
            {{-- TODO --}}
        </div>
    </div>

    <div class="booking-slot my-5 row w-100" style="display: none;">
        <div class="col-10">
            <h3 class="booking-day-slot mb-5 text-align-left col-10">Select A Slot</h3>
        </div>
        <div class="col-2">
            <button class="w-100 btn btn-primary booking-slot-back">Back</button>
        </div>
        <div class="row booking-slot-child">
            {{-- TODO --}}
        </div>
    </div>

    <div class="paymentDetails my-5 row w-100" style="display: none;">
        <div class="col-10">
            <h3 class="booking-day-slot mb-5 text-align-left col-10">Payment</h3>
        </div>
        <div class="col-2">
            <button class="w-100 btn btn-primary booking-payment-back">Back</button>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label" for="">Specialty</label>
                    <input class="form-control" type="text" name="" id="specialty" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Doctor</label>
                    <input class="form-control" type="text" name="" id="doctor" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Date</label>
                    <input class="form-control" type="text" name="" id="date" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Slot</label>
                    <input class="form-control" type="text" name="" id="slot" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Amount</label>
                    <input class="form-control" type="text" value="SAR 100" disabled>
                </div>
            </div>
            <div class="col-6">
                <button class="btn btn-primary w-100 my-3 pay-by-cash">Pay By Cash</button>
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('script')
<script src="https://www.paypal.com/sdk/js?client-id=ASq34EjrQ1DahPJ3LQnQ953YNVbNFkWqSkdMmDiPvxoEOazO46yt1MjO47bjzmuwc66EU22xS66mcj7u&currency=USD"></script>
<script>
    $(document).ready(function () {
        let specialityId = '';
        let specialityName = '';
        let doctorId = '';
        let doctorName = '';
        let day = '';
        let slot = ''
        let appData = {};

        // Selects Speciality and Loads List of Doctors
        $(document).on('click', '.spec-btn', function () {
            specialityId = $(this).closest('.spec-data').find('.spec-id').text();
            specialityName = $(this).closest('.spec-data').find('.card-title').text();

            $('.booking-speciality').hide(200);
            $('.booking-loading').show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/getSpecDocs',
                data: {
                    'id' : specialityId
                },
                type:'post',
                success:  function (response) {
                    // alert('success');
                    // console.log(response);
                    response.forEach(doctor => {
                        let card = `
                            <div class="doc-data card col-md-4 col-lg-3 col-sm-6 mb-2">
                                <div class="d-none doc-id">${doctor.id}</div>
                                <div class="card-body">
                                    <div class="card-title">
                                        ${doctor.name}
                                    </div>
                                    <p class="card-text">
                                        ${doctor.description}
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button class="doc-btn w-75 btn btn-primary">Select</button>
                                </div>
                            </div>
                        `;
                        $('.booking-doctor-child').append(card);
                        $('.booking-spec-doc').text(specialityName +  "'s Doctors")
                    });
                    $(".booking-loading").hide();
                    $(".booking-doctor").show(400);
                },
                error: function(x,xs,xt){
                    alert(x);

                }
            });
        });

        // Go from Doctors select to speciality Select
        $('.booking-doctor-back').click(function (e) {
            e.preventDefault();
            $('.booking-doctor').hide();
            $('.booking-speciality').show(400);
            $('.booking-doctor-child').empty();
        });

        $('.booking-day-back').click(function (e) {
            e.preventDefault();
            $('.booking-day').hide();
            $('.booking-doctor').show(400);
            $('.booking-day-child').empty();
        });

        $('.booking-slot-back').click(function (e) {
            e.preventDefault();
            $('.booking-slot').hide();
            $('.booking-day').show(400);
            $('.booking-slot-child').empty();
        });

        $('.booking-payment-back').click(function (e) {
            e.preventDefault();
            $('.paymentDetails').hide();
            $('.booking-slot').show(400);
            // $('.booking-slot-child').empty();
        });


        $(document).on('click', '.doc-btn', function () {
            $(".booking-doctor").hide();
            $(".booking-loading").show(400);

            doctorId = $(this).closest('.doc-data').find('.doc-id').text();
            doctorName = $(this).closest('.doc-data').find('.card-title').text();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/getDocApps',
                data: {
                    'id' : doctorId
                },
                type:'post',
                success:  function (response) {
                    appData = response;

                    for (day in response) {
                        let card = `
                            <div class="day-data card col-md-4 col-lg-3 col-sm-6 mb-2">
                                <div class="card-body">
                                    <div class="card-title">${day}</div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <button class="day-btn w-75 btn btn-primary">Select</button>
                                </div>
                            </div>
                        `;
                        $('.booking-day-child').append(card);
                    };


                    // $('.booking-doc-day').text(`${}' Slots`)
                    $(".booking-loading").hide();
                    $(".booking-day").show(400);
                },
            });
        });

        $(document).on('click', '.day-btn', function () {
            $(".booking-day").hide();
            $(".booking-loading").show(400);

            day = $(this).closest('.day-data').find('.card-title').text();
            console.log(day);
            console.log(appData[day]);
            for (slot in appData[day]){
                if (appData[day][slot].status == 'booked') {
                    // If the Slot is Booked
                    let card = `
                    <div class="slot-data card col-md-4 col-lg-3 col-sm-6 mb-2">
                        <div class="d-none slot-no">${slot}</div>
                        <div class="card-body">
                            <div class="card-title">
                                ${appData[day][slot].times}
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button disabled class="slot-btn w-75 btn btn-primary">Booked</button>
                        </div>
                    </div>
                    `;
                    $('.booking-slot-child').append(card);
                } else {
                    // Slot is not Booked
                    let card = `
                    <div class="slot-data card col-md-4 col-lg-3 col-sm-6 mb-2">
                        <div class="d-none slot-no">${slot}</div>
                        <div class="card-body">
                            <div class="card-title">
                                ${appData[day][slot].times}
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button class="slot-btn w-75 btn btn-primary">Select</button>
                        </div>
                    </div>
                    `;
                    $('.booking-slot-child').append(card);
                }
            }
            $(".booking-loading").hide();
            $(".booking-slot").show(400);

        });

        $(document).on('click', '.slot-btn', function () {
            $(".booking-slot").hide();
            $(".booking-loading").show(400);

            slot = $(this).closest('.slot-data').find('.slot-no').text()

            $(".booking-loading").hide();
            $('.paymentDetails').show(400);

            $('#specialty').val(specialityName);
            $('#doctor').val(doctorName);
            $('#date').val(day);
            $('#slot').val(slot);
        });

        $(document).on('click', '.pay-by-cash', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url:'/createApp',
                data: {
                    'doctor_id' : doctorId,
                    'date' : day,
                    'slot': slot,
                },
                type:'post',
                success:  function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        confirmButtonText: 'Appointment has been booked.',
                    }).then((result) => {
                        location.href = response;
                    });

                    location.reload();

                },
                error: function(x,xs,xt){
                    alert(x);

                }
            });
        });

        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                purchase_units: [{
                    amount: {
                    value: 100 // Can also reference a variable or function
                    }
                }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url:'/createApp',
                        data: {
                            'doctor_id' : doctorId,
                            'date' : day,
                            'slot': slot,
                            'is_paid': 1
                        },
                        type:'post',
                        success:  function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                confirmButtonText: 'Appointment has been booked.',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = response;
                                }else if (result.isDenied) {
                                    location.href = response;
                                }
                            });

                            location.reload();

                        },
                        error: function(x,xs,xt){
                            alert(x);

                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    });
</script>
@endsection
