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
        $nextId = Customer::nextId();

        return view('master.customer.create', compact('nextId'));
    }

    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::createWithAutoId($request->validated());

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

    /**
     * Delete a customer (was customer-hapus.php).
     *
     * Customers already referenced by a sales invoice must not be
     * removed — enforced first here for a friendly message, and backed
     * by an ON DELETE RESTRICT foreign key at the database level.
     */
    public function destroy(string $id): RedirectResponse
    {
        $item = Customer::findOrFail($id);

        if ($item->invoice()->exists()) {
            return redirect()
                ->route('customer.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        try {
            $item->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('customer.index')
                ->with('error', 'Data tidak dapat dihapus karena sudah digunakan pada transaksi.');
        }

        return redirect()
            ->route('customer.index')
            ->with('success', 'Data customer berhasil dihapus.');
    }
}
