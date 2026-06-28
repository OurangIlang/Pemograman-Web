<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaPembelianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
