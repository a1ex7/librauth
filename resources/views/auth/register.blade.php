@extends('app')

@section('tittle', 'Register')

@section('content')

@if ($errors->all())
    <div class="alert alert-danger">
        {!! HTML::ul($errors->all()) !!}
    </div>
@endif

<a href="{{ URL::to('auth/fb') }}" class="btn btn-primary" role="button">Login with Facebook</a>

<p align="center"><em>Or create a new one with your username and email</em></p>

<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="col-md-12 form-group">
        Firstname
        <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control">
    </div>

    <div class="col-md-12 form-group">
        Lastname
        <input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control">
    </div>

    <div class="col-md-12 form-group">
        Email
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>

    <div class="col-md-6 form-group">
        Password
        <input type="password" name="password" class="form-control">
    </div>

    <div class="col-md-6 form-group">
        Confirm Password
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <div class="col-md-12">
        <button type="submit"  class="btn btn-primary">Register</button>
    </div>
</form>

@stop