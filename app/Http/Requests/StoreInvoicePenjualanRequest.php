<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoicePenjualanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * For non-admin (pegawai) users, the employee performing the
     * transaction is always the currently authenticated user — it is
     * never taken from client input.
     */
    protected function prepareForValidation(): void
    {
        $user = $this->user();

        if ($user && ! $user->isAdmin() && $user->id_pegawai) {
            $this->merge(['id_pegawai' => $user->id_pegawai]);
        }
    }

    /**
     * no_invoice, no_faktur and no_preorder are all auto-generated
     * server-side (INV-/FK-/PO-YYYYMMDD-001, via
     * App\Traits\GeneratesDatedId) and must never be accepted from
     * client input.
     *
     * `items` carries the line items collected across step 2 of the
     * multi-step form. Each item only needs a product id and a
     * quantity — the price is always re-read from the barang master at
     * save time, never trusted from the request.
     */
    public function rules(): array
    {
        return [
            'tanggal' => ['required', 'date'],
            'id_customer' => ['required', 'string', 'exists:customer,id_customer'],
            'id_pegawai' => ['required', 'string', 'exists:pegawai,id_pegawai'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id_barang' => ['required', 'string', 'exists:barang,id_barang'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.deskripsi' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal' => 'Tanggal',
            'id_customer' => 'Customer',
            'id_pegawai' => 'Pegawai',
            'items' => 'Detail Barang',
            'items.*.id_barang' => 'Barang',
            'items.*.qty' => 'Qty',
        ];
    }
}
