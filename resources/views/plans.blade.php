@extends('layouts.main')


@section('content')
    <div id="create-plan-button-container">
        <button id="toggle-create-form-button"
            onclick="
                window.toggleVisibility('#create-plan');
            "
        >Create plan</button>
    </div>
    <section id="create-plan" style="display: none">
        <form action="" method="POST">
            @csrf
            <label for="name">Name: </label>
            <input type="text" id="name" name="name">
            <input type="submit" id="create-plan-submit-button">
        </form>
    </section>

    <div id="plans">
        @forelse ($plans as $plan)
        <section>
                <div class="plan-heading">
                    <h4 class="plan-title" id="plan-title-{{$plan->id}}">{{ $plan->name }}</h4>
                    <form class="edit-plan" id="edit-plan-{{$plan->id}}" style="display: none;" action="/plans/{{$plan->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="name">New name: </label>
                        <input type="text" name="name" value="{{$plan->name}}">
                        <input type="submit">
                        <div class="vl"></div>
                    </form>
                    <button class="inverted-button" id="plan-toggle-actions-button-for-{{$plan->id}}"
                        onclick="
                            window.toggleVisibility('#plan-actions-for-{{ $plan->id }}');
                            window.toggleVisibility('#plan-toggle-actions-button-for-{{$plan->id}}');
                        "
                    >...</button>
                    <div id="plan-actions-for-{{ $plan->id }}" class="plan-actions" style="display: none">
                        <button class="inverted-button"
                            onclick="
                                window.toggleVisibility('#plan-title-{{ $plan->id }}');
                                window.toggleVisibility('#edit-plan-{{ $plan->id }}');
                            "x
                        >Edit</button>
                        <button class="plan-delete-button" form="delete-{{ $plan->id }}">Delete</button>
                        <button class="inverted-button"
                            onclick="
                                window.toggleVisibility('#plan-actions-for-{{ $plan->id }}');
                                window.toggleVisibility('#plan-toggle-actions-button-for-{{$plan->id}}');
                            "
                        >X</button>
                        <form id="delete-{{$plan->id}}" action="/plans/{{$plan->id}}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
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
            </section>
        @empty
            <div id="no-plans">
                <p>You have not created any plans.</p>
            </div>
        @endforelse
    </div>
@endsection