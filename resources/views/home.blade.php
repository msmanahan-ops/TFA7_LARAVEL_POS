@extends('layouts.pos')

@section('title', 'Laravel POS Dashboard')

@section('content')
    <h1>Laravel POS</h1>

    <p>
        Welcome! Manage customer records and user accounts using
        Laravel forms, validation, and avatar uploads.
    </p>

    <a class="button" href="{{ route('customers.index') }}">
        Manage Customers
    </a>

    <a class="button" href="{{ route('users.index') }}">
        Manage User Accounts
    </a>

    <p class="hint">
        IT0049 — TFA7<br>
        Marixine Sofia S. Manahan
    </p>
@endsection