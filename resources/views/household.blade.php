@extends('layouts.main')

@section('content')
<h2>{{ $household_name }}</h2>
<p>Manage your household here</p>

<section>
    <div id="users-header">
        <b><u><em>Users</em></u></b>
        <a href="/household/add-user" target="_blank"><button>Add user</button></a>
    </div>
<table id="users-table">
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td id="delete-user">
                @if(Auth::id() != $user->id)
                    <button form="delete-{{$user->id}}" type="submit">Delete</button>
                @endif
            </td>
            <form id="delete-{{$user->id}}" action="/users/{{$user->id}}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </tr>
        @endforeach
</table>
</section>
@endsection