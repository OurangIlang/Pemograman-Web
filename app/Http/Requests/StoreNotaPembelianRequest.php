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

    public function rules(): array
    {
        return [
            'kode_nota' => ['required', 'string', 'max:20', 'unique:nota_pembelian,kode_nota'],
            'tanggal' => ['required', 'date'],
            'id_perusahaan' => ['required', 'string', 'exists:perusahaan,id_perusahaan'],
            'id_pegawai' => ['required', 'string', 'exists:pegawai,id_pegawai'],
            'informasi' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_nota' => 'Kode Nota',
            'tanggal' => 'Tanggal',
            'id_perusahaan' => 'Perusahaan',
            'id_pegawai' => 'Pegawai',
            'informasi' => 'Informasi',
        ];
    }
}
