<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * The ID is auto-generated server-side (App\Traits\GeneratesId) and
     * must never be accepted from client input.
     */
    public function rules(): array
    {
        return [
            'nama_pegawai' => ['required', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_pegawai' => 'Nama Pegawai',
        ];
    }
}
