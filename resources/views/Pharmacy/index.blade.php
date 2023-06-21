@extends('Layouts.FrontEnd.layout')

@section('title')
   Pharmacy
@endsection

@section('content')
<div class="home-mid mt-5">
    <h1 class="mb-5 w-100 text-align-left">Pharmacy</h1>
    <div class="input-group rounded mb-3">
        <input id="search" type="search" class="form-control rounded" placeholder="Search by Patient Name" aria-label="Search" aria-describedby="search-addon" />
    </div>
    <table id="table" class="table" style="border-color: rgb(0, 48, 89)">
        <thead>
            <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Doctor Name</th>
                <th class="text-center" scope="col">Patient Name</th>
                <th class="text-center" scope="col">More</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $app)
            <tr>
                <th class="text-center" scope="row">{{ $app->id }}</th>
                <td class="text-center">{{ $app->patient->name }}</td>
                <td class="text-center">{{ $app->doctor->name }}</td>
                <td class="text-end">
                    <button id="{{ $app->id }}" class="viewPerscription btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewPerscription">View Prescription</button>
                    <a class="btn btn-success" href="{{ route('pharmacy.adminster', ['appointment' => $app]) }}">Adminster Prescription</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="viewPerscription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="viewPerscriptionSpinner modal-body">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        {{-- <span class="visually-hidden">Loading...</span> --}}
                    </div>
                </div>
            </div>
            <div class="viewPerscriptionModal" style="display: none;">
                <div class="modal-body addPerscription-details">
                    <table class="perscriptionTable w-100">
                        <thead>
                          <tr>
                            <th scope="col">Medicine</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody class="perscriptionDetails">

                        </tbody>
                      </table>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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

        $(document).on('click', '.viewPerscription', function () {
            let id = $(this).attr('id');
            let total = 0;

            $(".viewPerscriptionSpinner").show();
            $(".viewPerscriptionModal").hide();
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

                    response.data.forEach(element => {
                        total += element.price;
                        let row = $(`
                        <tr>
                            <td>${element.name}</td>
                            <td>${element.dosage}</td>
                            <td>SAR ${element.price}</td>
                        </tr>
                        `);
                        $('.perscriptionDetails').append(row);
                    });
                    let row = $(`
                    <tr>
                        <th scope='row'>Total Price</th>
                        <td></td>
                        <td>SAR ${total}</td>
                    </tr>
                    `);
                    $('.perscriptionDetails').append(row)
                    $(".viewPerscriptionSpinner").hide();
                    $(".viewPerscriptionModal").show(400);
                },
                error: function(x,xs,xt){
                    // alert(x);

                }
            });
        });
    });
</script>
@endsection
