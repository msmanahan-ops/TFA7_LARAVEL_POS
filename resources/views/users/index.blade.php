@extends('layouts.pos')

@section('title', 'User Accounts')

@section('content')
    <h1>User Accounts</h1>

    <a class="button" href="{{ route('users.create') }}">
        Create User
    </a>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            <img
                                class="avatar"
                                src="{{ $user->avatar
                                    ? asset('storage/' . $user->avatar)
                                    : asset('images/avatar-placeholder.svg') }}"
                                alt="Avatar of {{ $user->name }}"
                                width="64"
                                height="64"
                            >
                        </td>

                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            <a href="{{ route('users.edit', $user) }}">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No user accounts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection