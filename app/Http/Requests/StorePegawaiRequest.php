<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pegawai' => ['required', 'string', 'max:10', 'unique:pegawai,id_pegawai'],
            'nama_pegawai' => ['required', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'id_pegawai' => 'ID Pegawai',
            'nama_pegawai' => 'Nama Pegawai',
        ];
    }
}
