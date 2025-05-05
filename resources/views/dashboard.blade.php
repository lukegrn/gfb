@extends('layouts.main')

@section('header')
<header style="text-align: right; padding-top: 2rem;">
    <button form="logout" type="submit">Log out</button>
    <form id=logout action="/logout" method="POST" style="display: none;">@csrf</form>
</header>
@endsection

@section('content')
<p>Hello, dashboard</p>
@endsection