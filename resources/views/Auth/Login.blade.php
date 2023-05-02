@extends('Layouts.FrontEnd.layout')

@section('title')
Login
@endsection

@section('content')
<div class="batates">
    <div class="mdi">
        <div class="sec1">
            <a style="color: inherit;" class="text-decoration-none login-btn" href="">
                <h1>Login</h1>
            </a>
            <div class="x"></div>
            <a style="color: inherit;" class="text-decoration-none register-btn" href="">
                <h1>Register</h1>
            </a>
        </div>
        <div class="sec2">
            <div class="login d-none">
                <h1 class="mb-1">Login</h1>
                <div class="line-dark mb-5"></div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button class="btn btn-primary float-end w-25" style="height: 50px;">Submit</button>
            </div>
            <div class="register">
                <h1 class="mb-1">Register</h1>
                <div class="line-dark mb-5"></div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="">First and last name</span>
                    </div>
                    <input type="text" class="form-control">
                    <input type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-5">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary float-end w-25" style="height: 50px;">Register</button>
            </div>
        </div>
    </div>
</div>
@endsection
