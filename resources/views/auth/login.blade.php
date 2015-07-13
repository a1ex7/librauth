@extends('app')

@section('tittle', 'Login')

@section('content')

@if ($errors->all())
    <div class="alert alert-danger">
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

<p align="center"><em>Login with your Facebook</em></p>

<a href="{{ URL::to('auth/fb') }}" class="btn btn-primary" role="button">Login with Facebook</a>

<p align="center"><em>Or login with your username or email</em></p>

<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"  class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" id="password">
    </div>

    <div class="form-group">
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>


</form>

@stop