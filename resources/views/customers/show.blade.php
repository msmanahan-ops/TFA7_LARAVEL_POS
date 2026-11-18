@extends('layouts.pos')

@section('title', 'Customer Details')

@section('content')
    <h1>Customer Details</h1>

    <p>
        <strong>Full Name:</strong>
        {{ $customer->full_name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $customer->email }}
    </p>

    <p>
        <strong>Phone:</strong>
        {{ $customer->phone ?: 'Not provided' }}
    </p>

    <p>
        <strong>Address:</strong>
        {{ $customer->address ?: 'Not provided' }}
    </p>

    <a
        class="button"
        href="{{ route('customers.edit', $customer) }}"
    >
        Edit Customer
    </a>

    <a href="{{ route('customers.index') }}">
        Back to Customers
    </a>
@endsection