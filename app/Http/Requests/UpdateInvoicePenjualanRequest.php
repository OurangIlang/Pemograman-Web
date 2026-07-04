<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoicePenjualanRequest extends FormRequest
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
            'no_faktur' => ['nullable', 'string', 'max:20'],
            'no_preorder' => ['nullable', 'string', 'max:20'],
            'id_customer' => ['required', 'string', 'exists:customer,id_customer'],
            'id_pegawai' => ['required', 'string', 'exists:pegawai,id_pegawai'],
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal' => 'Tanggal',
            'no_faktur' => 'No Faktur',
            'no_preorder' => 'No Preorder',
            'id_customer' => 'Customer',
            'id_pegawai' => 'Pegawai',
        ];
    }
}
