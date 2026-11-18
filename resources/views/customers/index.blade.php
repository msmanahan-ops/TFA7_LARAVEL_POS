@extends('layouts.pos')

@section('title', 'Customer Accounts')

@section('content')
    <h1>Customer Accounts</h1>

    <a class="button" href="{{ route('customers.create') }}">
        Create Customer
    </a>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>
    <a href="{{ route('customers.show', $customer) }}">
        View
    </a>

    |

    <a href="{{ route('customers.edit', $customer) }}">
        Edit
    </a>

    <form
        method="POST"
        action="{{ route('customers.destroy', $customer) }}"
        onsubmit="return confirm('Delete this customer?');"
        style="display: inline;"
    >
        @csrf
        @method('DELETE')

        <button type="submit">
            Delete
        </button>
    </form>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No customers yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection