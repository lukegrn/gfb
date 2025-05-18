@extends('layouts.main')

@section('header')
<header>
    <h1>GFB</h1>
</header>
@endsection

@section('content')
<form action="" method="POST">
    @csrf
    <label for="email">Email: </label>
    <input type="email" name="email" id="email" required value="{{ old('email') }}"/>
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" required />
    <label for="remember">Remember me: </label>
    <input type="checkbox" name="remember" id="remember" value="1" @checked(old('remember')) />
    <br />
    <input type="submit" />
</form>

@foreach ($errors->all() as $error)
    <p class="error">Error: {{ $error }} </p>
@endforeach

<p>Don't have an account? <a href="/signup">Sign up here.</a></p>
@endsection