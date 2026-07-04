<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotaPembelianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Keep the employee tied to the currently authenticated user for
     * non-admin roles, regardless of what was submitted.
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
            'tanggal' => ['required', 'date'],
            'id_perusahaan' => ['required', 'string', 'exists:perusahaan,id_perusahaan'],
            'id_pegawai' => ['required', 'string', 'exists:pegawai,id_pegawai'],
            'informasi' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal' => 'Tanggal',
            'id_perusahaan' => 'Perusahaan',
            'id_pegawai' => 'Pegawai',
            'informasi' => 'Informasi',
        ];
    }
}
