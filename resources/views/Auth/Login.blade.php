@extends('Layouts.FrontEnd.layout')

@section('title')
Login
@endsection

@section('content')
<div class="login-page-layout">
    <div class="mid">
        <div class="sec1">
            <div class="x text-decoration-none login-form-btn" >
                <h1>Login</h1>
            </div>
            <div class="seperator-light"></div>
            <div class="x text-decoration-none register-form-btn" >
                <h1>Register</h1>
            </div>
        </div>
        <div class="sec2">
            <form id="form-login" action="{{ route('frontend.login') }}" method="post">
                @csrf
                <div class="login">
                    <h1 class="mb-1">Login</h1>
                    <div class="line-dark-login mb-5"></div>
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="loginEmail" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="loginPass" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="loginPass">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="login-btn btn btn-primary float-end w-25" style="height: 50px;">Login</button>
                </div>
            </form>
            <div class="register" style="display: none;">
                <h1 class="mb-1">Register</h1>
                <div class="line-dark-register mb-5"></div>
                <form id="register-form" action="{{ route('frontend.register') }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="">First and last name</span>
                        </div>
                        <input type="text" name="reg_first_name" id="regFirstName" class="form-control" value="{{ old('reg_first_name') }}">
                        <input type="text" name="reg_last_name" id="regLastName" class="form-control" value="{{ old('reg_last_name') }}">
                    </div>
                    <div id="nameHelp" class="form-text text-danger mt-0 mb-3"></div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="reg_email" class="form-control" id="regEmail" value="{{ old('reg_email') }}">
                        @error('reg_email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div id="emailHelp" class="form-text text-danger"></div>
                    </div>

                    <div class="mb-5">
                        <label for="regPass" class="form-label">Password</label>
                        <input type="password" name="reg_password" class="form-control" id="regPass" >
                        <div id="passHelp" class="form-text text-danger"></div>
                        @error('reg_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="register-btn btn btn-primary float-end w-25" style="height: 50px;">Register</button>
                </form>
            </div>
            <div class="loading" style="display: none;">
                <div class="spinner-grow text-primary me-3" role="status"></div>
                <div class="spinner-grow text-primary me-3" role="status"></div>
                <div class="spinner-grow text-primary" role="status"></div>
            </div>
        </div>
    </div>
</div>
@endsection
