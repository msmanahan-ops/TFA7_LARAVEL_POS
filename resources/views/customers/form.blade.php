@extends('layouts.pos')

@section('title', $customer->exists ? 'Edit Customer' : 'Create Customer')

@section('content')
    <h1>{{ $customer->exists ? 'Edit Customer' : 'Create Customer' }}</h1>

    <form
        method="POST"
        action="{{ $customer->exists
            ? route('customers.update', $customer)
            : route('customers.store') }}"
    >
        @csrf

        @if ($customer->exists)
            @method('PUT')
        @endif

        <label for="full_name">Full Name *</label>
        <input
            id="full_name"
            name="full_name"
            value="{{ old('full_name', $customer->full_name) }}"
            maxlength="255"
            required
        >
        @error('full_name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Email *</label>
        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $customer->email) }}"
            maxlength="255"
            required
        >
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="phone">Phone</label>
        <input
            id="phone"
            type="tel"
            name="phone"
            value="{{ old('phone', $customer->phone) }}"
            maxlength="30"
        >
        @error('phone')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="address">Address</label>
        <textarea
            id="address"
            name="address"
            maxlength="255"
        >{{ old('address', $customer->address) }}</textarea>

        @error('address')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">
            {{ $customer->exists ? 'Update Customer' : 'Save Customer' }}
        </button>

        <a href="{{ route('customers.index') }}">Cancel</a>
    </form>
@endsection