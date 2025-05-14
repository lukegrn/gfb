@extends('layouts.main')


@section('content')
    @foreach ($plans as $plan)
        <h3>Plan: {{ $plan->name }}</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Amount Allocated</th>
                <th>Sinking</th>
            </tr>
        @foreach ($plan->lineItems as $lineItem)
            <tr>
                <td>{{ $lineItem->name }}</td>
                <td>{{ $lineItem->alloc }}</td>
                <td>{{ $lineItem->sinking ? "☑" : "☒" }}</td>
            </tr>
        @endforeach
        </table>
    @endforeach
@endsection