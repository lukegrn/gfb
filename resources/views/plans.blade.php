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
                        <button class="delete-button" form="delete-{{ $plan->id }}">Delete</button>
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
                <table id="line-items-for-plan-{{$plan->id}}" class="line-items-for-plan">
                    <tr>
                        <th>Name</th>
                        <th class="right-align">Amount Allocated</th>
                        <th>Sinking</th>
                    </tr>
                    @foreach ($plan->lineItems as $lineItem)
                        <tr>
                            <td id="line-item-name-{{$lineItem->id}}">{{ $lineItem->name }}</td>
                            <td id="line-item-alloc-{{$lineItem->id}}" class="right-align">${{ number_format($lineItem->alloc, 2) }}</td>
                            <td id="line-item-sinking-{{$lineItem->id}}" class="shrink center-align line-item-{{$lineItem->id}}">{{ $lineItem->sinking ? "☑" : "☐" }}</td>
                            <td style="display: none;" id="edit-line-item-{{$lineItem->id}}" colspan="3">
                                <form class="inline-form" action="plans/{{$plan->id}}/lineItems/{{$lineItem->id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="name">Name: </label>
                                    <input class="line-item-form-name" type="text" name="name" value="{{$lineItem->name}}">
                                    <label for="alloc">Amount: </label>
                                    <input class="line-item-form-alloc" type="number" step="0.01" name="alloc" value="{{$lineItem->alloc}}">
                                    <label for="sinking">Sinking: </label>
                                    <input type="checkbox" value="1" name="sinking" @checked($lineItem->sinking)>
                                    <input type="submit" value="☑">
                                </form>
                            </td>
                            <td class="shrink">
                                <button
                                    class="inverted-button"
                                    onclick="
                                        window.toggleVisibility('#line-item-name-{{$lineItem->id}}');
                                        window.toggleVisibility('#line-item-alloc-{{$lineItem->id}}');
                                        window.toggleVisibility('#line-item-sinking-{{$lineItem->id}}');
                                        window.toggleVisibility('#edit-line-item-{{$lineItem->id}}');
                                    "
                                >Edit</button>
                                <button class="delete-button" form="delete-{{$plan->id}}-lineItem-{{$lineItem->id}}">X</button>
                            </td>
                        </tr>
                        <form
                            id="delete-{{$plan->id}}-lineItem-{{$lineItem->id}}"
                            action="/plans/{{$plan->id}}/lineItems/{{$lineItem->id}}"
                            method="POST"
                            style="display: none;"
                        >
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                    <tr id="line-item-form-for-plan-{{$plan->id}}" style="display: none;" class="line-item-form">
                        <td colspan="5">
                            <form class="inline-form" action="plans/{{$plan->id}}/lineItems" method="POST">
                                @csrf
                                <label for="name">Name: </label>
                                <input class="line-item-form-name" type="text" name="name">
                                <label for="alloc">Amount: </label>
                                <input class="line-item-form-alloc" type="number" step="0.01" name="alloc">
                                <label for="sinking">Sinking: </label>
                                <input type="checkbox" value="1" name="sinking">
                                <input type="submit" value="Add">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="add-line-item">
                            <button
                                onclick="window.toggleVisibility('#line-item-form-for-plan-{{$plan->id}}');"
                            >+ Line Item</button>
                        </td>
                    </tr>
                </table>
            </section>
        @empty
            <div id="no-plans">
                <p>You have not created any plans.</p>
            </div>
        @endforelse
        {{-- Stubbed out for troubleshooting form errors --}}
        {{-- {{$errors}} --}}
    </div>
@endsection