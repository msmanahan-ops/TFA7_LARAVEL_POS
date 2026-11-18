<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.form', [
            'customer' => new Customer(),
        ]);
    }

    public function store(Request $request)
    {
        Customer::create($this->validateCustomer($request));

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update(
            $this->validateCustomer($request, $customer)
        );

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    private function validateCustomer(
        Request $request,
        ?Customer $customer = null
    ): array {
        $emailRule = Rule::unique('customers', 'email');

        if ($customer) {
            $emailRule->ignore($customer);
        }

        return $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $emailRule],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);
    }
}