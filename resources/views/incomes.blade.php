@extends('layouts.main')

@section('content')
<div id="create-plan-button-container">
    <button id="toggle-create-form-button"
        onclick="
            window.toggleVisibility('#create-income');
        "
    >Create income</button>
</div>
<section id="create-income" style="display: none">
    <form action="" method="POST" class="inline-form">
        @csrf
        <label for="name">Income name: </label>
        <input class="income-form-name" type="text" id="name" name="name">
        <label for="expectation">Expected amt: </label>
        <input class="income-form-exp" type="number" step="0.01" id="expectation" name="expectation">
        <input type="submit" id="create-income-submit-button">
    </form>
</section>

@if (count($incomes) == 0)
    <p>No incomes created</p>
@else
    <table id="incomes-table">
        <tr>
            <th>Name</th>
            <th class="right-align">Amount Expected</th>
        </tr>
        @foreach ($incomes as $income)
            <tr>
                <td id="income-name-{{$income->id}}">{{$income->name}}</td>
                <td class="right-align" id="income-expectation-{{$income->id}}">${{number_format($income->expectation, 2)}}</td>
                <td style="display: none;" id="edit-income-{{$income->id}}" colspan="2">
                    <form class="inline-form" action="incomes/{{$income->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="name">Name: </label>
                        <input class="income-form-name" type="text" name="name" value="{{$income->name}}">
                        <label for="expectation">Expected amt: </label>
                        <input class="income-form-exp" type="number" step="0.01" name="expectation" value="{{$income->expectation}}">
                        <input type="submit" value="☑">
                    </form>
                </td>
                <td colspan="2" class="shrink">
                    <button class="inverted-button"
                        onclick="
                            window.toggleVisibility('#edit-income-{{$income->id}}');
                            window.toggleVisibility('#income-name-{{$income->id}}');
                            window.toggleVisibility('#income-expectation-{{$income->id}}');
                        "
                    >Edit</button>
                    <button form="delete-income-{{$income->id}}" class="delete-button">X</button>
                </td>
                <form
                    id="delete-income-{{$income->id}}"
                    action="/incomes/{{$income->id}}"
                    method="POST"
                    style="display: none;"
                >
                    @csrf
                    @method('DELETE')
                </form>
            </tr>
        @endforeach
    </table>
@endif
@endsection