@extends('Layouts.FrontEnd.layout')

@section('title')

@endsection

@section('content')
<div class="">
    @foreach ($specs as $spec)
        <div class="home-mid mt-5">
            <div class="d-flex justify-content-between w-100">
                <h2>{{ $spec->name }}</h2>
                <h2>{{ $spec->short_description }}</h2>
                <h2>{{ $spec->doctors->count() }}</h2>
            </div>
        </div>
    @endforeach
</div>
@endsection
