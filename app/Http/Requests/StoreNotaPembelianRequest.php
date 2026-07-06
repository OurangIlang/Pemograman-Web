<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaPembelianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * For non-admin (pegawai) users, the employee performing the
     * transaction is always the currently authenticated user — it is
     * never taken from client input. This guarantees the value cannot
     * be tampered with and matches the "auto-fill pegawai" requirement.
     */
    protected function prepareForValidation(): void
    {
        $user = $this->user();

        if ($user && ! $user->isAdmin() && $user->id_pegawai) {
            $this->merge(['id_pegawai' => $user->id_pegawai]);
        }
    }

    /**
     * The kode_nota is auto-generated server-side (NP-YYYYMMDD-001, via
     * App\Traits\GeneratesDatedId) and must never be accepted from
     * client input.
     *
     * `items` carries the line items collected across step 2 of the
     * multi-step form. Each item only needs a raw-material id and a
     * quantity — the price is always re-read from the bahan_baku
     * master at save time, never trusted from the request.
     */
    public function rules(): array
    {
        return [
            'tanggal' => ['required', 'date'],
            'id_perusahaan' => ['required', 'string', 'exists:perusahaan,id_perusahaan'],
            'id_pegawai' => ['required', 'string', 'exists:pegawai,id_pegawai'],
            'informasi' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.id_bahan_baku' => ['required', 'string', 'exists:bahan_baku,id_bahan_baku'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'items.*.keterangan' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal' => 'Tanggal',
            'id_perusahaan' => 'Perusahaan',
            'id_pegawai' => 'Pegawai',
            'informasi' => 'Informasi',
            'items' => 'Detail Bahan Baku',
            'items.*.id_bahan_baku' => 'Bahan Baku',
            'items.*.qty' => 'Qty',
        ];
    }
}
