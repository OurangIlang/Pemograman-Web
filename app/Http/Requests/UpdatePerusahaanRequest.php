<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerusahaanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_perusahaan' => ['required', 'string', 'max:100'],
            'alamat_perusahaan' => ['nullable', 'string', 'max:255'],
            'no_telpon' => ['nullable', 'string', 'max:20'],
            'no_fax' => ['nullable', 'string', 'max:20'],
            'email_perusahaan' => ['nullable', 'email', 'max:100'],
            'nama_petugas' => ['nullable', 'string', 'max:100'],
            'nama_penandatangan' => ['nullable', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_perusahaan' => 'Nama Perusahaan',
            'alamat_perusahaan' => 'Alamat',
            'no_telpon' => 'No. Telpon',
            'no_fax' => 'No. Fax',
            'email_perusahaan' => 'Email',
            'nama_petugas' => 'Nama Petugas',
            'nama_penandatangan' => 'Nama Penandatangan',
            'jabatan' => 'Jabatan',
        ];
    }
}
