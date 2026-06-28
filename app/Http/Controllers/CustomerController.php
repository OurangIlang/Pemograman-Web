<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Customer master CRUD.
 *
 * Migrated from customer/customer-{lihat,tambah,ubah,hapus}.php.
 */
class CustomerController extends Controller
{
    public function index(): View
    {
        $items = Customer::all();

        return view('master.customer.index', compact('items'));
    }

    public function create(): View
    {
        return view('master.customer.create');
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return redirect()
            ->route('customer.index')
            ->with('success', 'Data customer berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $item = Customer::findOrFail($id);

        return view('master.customer.edit', compact('item'));
    }

    public function update(UpdateCustomerRequest $request, string $id): RedirectResponse
    {
        $item = Customer::findOrFail($id);
        $item->update($request->validated());

        return redirect()
            ->route('customer.index')
            ->with('success', 'Data customer berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Customer::where('id_customer', $id)->delete();

        return redirect()
            ->route('customer.index')
            ->with('success', 'Data customer berhasil dihapus.');
    }
}
