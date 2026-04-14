<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKeterlambatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasRole('ketua_tingkat');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_jadwal'          => ['required', 'integer', 'exists:jadwal,id_jadwal'],            
            'id_asisten'         => ['required', 'integer', 'exists:asisten,id_asisten'],
            // Format waktu HH:MM (contoh: 08:15)
            'waktu_masuk_aktual' => ['required', 'date_format:H:i'],
            'deskripsi'          => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'id_jadwal.required'          => 'Jadwal wajib dipilih.',
            'id_jadwal.exists'            => 'Jadwal yang dipilih tidak valid.',
            'id_asisten.required'         => 'Asisten wajib dipilih.',
            'id_asisten.exists'           => 'Asisten yang dipilih tidak valid.',
            'waktu_masuk_aktual.required' => 'Waktu masuk asisten wajib diisi.',
            'waktu_masuk_aktual.date_format' => 'Format waktu tidak valid (harus HH:MM).',
        ];
    }
}
