@extends('layouts.pos')

@section('title', 'Laravel POS Dashboard')

@section('content')
    <h1>Laravel POS</h1>

    @auth
        <p>
            Welcome, {{ auth()->user()->name }}!
            You are logged in.
        </p>

        <p>
            Manage customer records and user accounts below.
        </p>

        <a class="button" href="{{ route('customers.index') }}">
            Manage Customers
        </a>

        <a class="button" href="{{ route('users.index') }}">
            Manage User Accounts
        </a>
    @else
        <p>
            Welcome to the Laravel POS application.
            Please log in to manage account records.
        </p>

        <a class="button" href="{{ route('login') }}">
            Login
        </a>

        <a class="button" href="{{ route('register') }}">
            Create an Account
        </a>
    @endauth

    <p class="hint">
        IT0049 — TFA8<br>
        Marixine Sofia S. Manahan
    </p>
@endsection