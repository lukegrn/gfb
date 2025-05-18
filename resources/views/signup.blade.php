@extends('layouts.main')

@section('header')
<header>
    <h1>GFB - Sign Up</h1>
</header>
@endsection

@section('content')
<form action="" method="POST">
    @csrf
    <label for="name">Name: </label>
    <input name="name" id="name" required />
    <label for="email">Email: </label>
    <input type="email" name="email" id="email" required class="@error('email') is-invalid @enderror"/>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" required />
    <label for="confirm_password">Confirm password: </label>
    <input type="password" name="confirm_password" id="confirm_password" required />
    <label form="household">Household name:</label>
    <input name="household" id="household" required />
    <label for="signup_code">SignUp key: </label>
    <input name="signup_code" id="signup_code" />
    <br />
    <input type="submit" />

    @foreach ($errors->all() as $error)
        <p class="error">Error: {{ $error }} </p>
    @endforeach
</form>
@endsection