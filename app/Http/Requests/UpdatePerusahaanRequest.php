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
        $id = $this->route('perusahaan');

        return [
            'nama_perusahaan' => ['required', 'string', 'max:100', 'unique:perusahaan,nama_perusahaan,'.$id.',id_perusahaan'],
            'alamat_perusahaan' => ['nullable', 'string', 'max:255'],
            'kota' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'no_telpon' => ['nullable', 'string', 'max:20'],
            'no_fax' => ['nullable', 'string', 'max:20'],
            'email_perusahaan' => ['nullable', 'email', 'max:100'],
            'nama_petugas' => ['nullable', 'string', 'max:100'],
            'pic' => ['nullable', 'string', 'max:100'],
            'npwp' => ['nullable', 'string', 'max:30', 'unique:perusahaan,npwp,'.$id.',id_perusahaan'],
            'nama_penandatangan' => ['nullable', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'keterangan' => ['nullable', 'string'],
            'status_aktif' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_perusahaan' => 'Nama Perusahaan',
            'alamat_perusahaan' => 'Alamat',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'kode_pos' => 'Kode Pos',
            'no_telpon' => 'No. Telpon',
            'no_fax' => 'No. Fax',
            'email_perusahaan' => 'Email',
            'nama_petugas' => 'Nama Petugas',
            'pic' => 'PIC',
            'npwp' => 'NPWP',
            'nama_penandatangan' => 'Nama Penandatangan',
            'jabatan' => 'Jabatan',
            'keterangan' => 'Keterangan',
            'status_aktif' => 'Status Aktif',
        ];
    }
}
