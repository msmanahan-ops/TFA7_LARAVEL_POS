@extends('layouts.pos')

@section('title', 'User Details')

@section('content')
    <h1>User Details</h1>

    <img
        class="avatar"
        src="{{ $user->avatar
            ? asset('storage/' . $user->avatar)
            : asset('images/avatar-placeholder.svg') }}"
        alt="Avatar of {{ $user->name }}"
        width="64"
        height="64"
    >

    <p>
        <strong>Full Name:</strong>
        {{ $user->name }}
    </p>

    <p>
        <strong>Username:</strong>
        {{ $user->username ?: 'Not set' }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $user->email }}
    </p>

    <a
        class="button"
        href="{{ route('users.edit', $user) }}"
    >
        Edit User
    </a>

    <a href="{{ route('users.index') }}">
        Back to User Accounts
    </a>
@endsection