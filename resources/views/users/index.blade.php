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
    <a href="{{ route('users.show', $user) }}">
        View
    </a>

    |

    <a href="{{ route('users.edit', $user) }}">
        Edit
    </a>

    @if (auth()->id() !== $user->id)
        <form
            method="POST"
            action="{{ route('users.destroy', $user) }}"
            onsubmit="return confirm('Delete this user?');"
            style="display: inline;"
        >
            @csrf
            @method('DELETE')

            <button type="submit">
                Delete
            </button>
        </form>
    @else
        <span class="hint">Your account</span>
    @endif
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