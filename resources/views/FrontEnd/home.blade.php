@extends('Layouts.FrontEnd.layout')


@section('content')
<div class="batates">
    <div class="mdi">
        <div class="sec1">
            <h1>Hello</h1>
        </div>
        <div class="sec2">
            <h1>World</h1>
            <a class="btn btn-primary" href="{{ route('login') }}"></a>
        </div>
    </div>
</div>
@endsection
