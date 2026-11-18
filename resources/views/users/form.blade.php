@extends('layouts.pos')

@section('title', $user->exists ? 'Edit User' : 'Create User')

@section('content')
    <h1>{{ $user->exists ? 'Edit User' : 'Create User' }}</h1>

    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ $user->exists
            ? route('users.update', $user)
            : route('users.store') }}"
    >
        @csrf

        @if ($user->exists)
            @method('PUT')
        @endif

        <label for="full_name">Full Name *</label>
        <input
            id="full_name"
            name="full_name"
            value="{{ old('full_name', $user->name) }}"
            maxlength="255"
            required
        >
        @error('full_name')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="username">Username *</label>
        <input
            id="username"
            name="username"
            value="{{ old('username', $user->username) }}"
            maxlength="100"
            required
        >
        @error('username')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Email *</label>
        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            maxlength="255"
            required
        >
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password">
            {{ $user->exists ? 'New Password' : 'Password *' }}
        </label>
        <input
            id="password"
            type="password"
            name="password"
            minlength="8"
            autocomplete="new-password"
            @required(!$user->exists)
        >
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        @if ($user->exists)
            <p class="hint">
                Leave blank to keep the current password.
            </p>
        @endif

        <label for="password_confirmation">Confirm Password</label>
        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            minlength="8"
            autocomplete="new-password"
            @required(!$user->exists)
        >

        @if ($user->exists)
            <label>Current Avatar</label>

            <img
                class="avatar"
                src="{{ $user->avatar
                    ? asset('storage/' . $user->avatar)
                    : asset('images/avatar-placeholder.svg') }}"
                alt="Current avatar"
                width="64"
                height="64"
            >

            <label for="avatar">Upload New Avatar</label>
            <input
                id="avatar"
                type="file"
                name="avatar"
                accept=".jpg,.jpeg,.png"
            >

            <p class="hint">
                JPG or PNG. Maximum 2 MB and 4096 × 4096 pixels.
                Saved as a 256 × 256 thumbnail.
                Leave blank to keep the current image.
            </p>

            @error('avatar')
                <div class="error">{{ $message }}</div>
            @enderror
        @else
            <p class="hint">
                Create the account first, then click Edit to upload an avatar.
            </p>
        @endif

        <button type="submit">
            {{ $user->exists ? 'Update User' : 'Save User' }}
        </button>

        <a href="{{ route('users.index') }}">Cancel</a>
    </form>
@endsection