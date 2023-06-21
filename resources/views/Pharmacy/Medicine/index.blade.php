@extends('Layouts.FrontEnd.layout')

@section('title')
   Medicine
@endsection

@section('content')
<div class="home-mid mt-5">
    <div class="mb-3 w-100 d-flex justify-content-between">
        <h1 class="text-align-left">Medicine</h1>
        <button class="AddMedicine btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMedicine">Add Medicine</button>
    </div>
    <div class="input-group rounded mb-3">
        <input id="search" type="search" class="form-control rounded" placeholder="Search by Medicine Name" aria-label="Search" aria-describedby="search-addon" />
    </div>
    <table id="table" class="table" style="border-color: rgb(0, 48, 89)">
        <thead>
            <tr>
                <th class="text-center" scope="col">ID</th>
                <th class="text-center" scope="col">Name</th>
                <th class="text-center" scope="col">Quantity</th>
                <th class="text-center" scope="col">Price</th>
                <th class="text-center" scope="col">More</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $med)
            <tr class="med-data">
                <th class="text-center" scope="row">{{ $med->id }}</th>
                <td class="text-center">{{ $med->name }}</td>
                <td class="text-center medQty">{{ $med->quantity }}</td>
                <td class="text-center">SAR {{ $med->price }}</td>
                <td class="text-end">
                    <button id="{{ $med->id }}" class="addQuantity btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuantity">Add Quantity</button>
                    <a class="btn btn-danger" href="{{ route('medicine.delete', ['medicine' => $med]) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="addQuantity" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Quantity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="addQuantityModal">
                <div class="modal-body">
                    <form action="{{ route('medicine.update') }}" method="POST">
                        @csrf
                        <input type="text" class="addQuantity-medId d-none" name="medicine_id">
                        <div class="mb-3">
                            <label class="form-label">Enter Amount to Add</label>
                            <input type="number" class="form-control" name="qty">
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

<div class="modal fade" id="addMedicine" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="addMedicineModal">
                <div class="modal-body">
                    <form action="{{ route('medicine.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" class="form-control" name="quantity">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price (SAR)</label>
                            <input type="number" class="form-control" name="price">
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

@endsection

@section('script')
<script>
    $(document).ready(function () {
        let rows = $('#table tbody tr');

        $('#search').keyup(function() {
            let val = $('#search').val();

            rows.each(function (index, apt) {
                let row = $(apt);
                let text = $(row.children()[1]).text();

                if (text.toUpperCase().indexOf(val.toUpperCase()) > -1) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        });

        $(document).on('click', '.addQuantity', function () {
            let id = $(this).attr('id');
            console.log(id);
            $('.addQuantity-medId').val(id);
        });
    });
</script>
@endsection
