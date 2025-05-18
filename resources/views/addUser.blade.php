@extends('layouts.main')

@section('header')
@endsection

@section('content')
<h2>Add User</h2>
<section>
    <p>
        Copy the following link and send it to the person you want to create an account.
        They will automatically be added to your household upon signup.
        This link expires in 7 days.
    </p>
    <a href={{ $link }}>{{ $link }}</a>
</section>
@endsection