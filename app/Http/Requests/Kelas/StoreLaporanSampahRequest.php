<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanSampahRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->hasAnyRole(['ketua_tingkat', 'asisten']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_ruangan'  => ['required', 'integer', 'exists:ruangan,id_ruangan'],
            'foto_sampah' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // max 5MB
            'deskripsi'   => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'id_ruangan.required'  => 'Ruangan/Lab wajib dipilih.',
            'id_ruangan.exists'    => 'Ruangan yang dipilih tidak valid.',
            'foto_sampah.required' => 'Foto bukti sampah wajib diunggah.',
            'foto_sampah.image'    => 'File harus berupa gambar.',
            'foto_sampah.mimes'    => 'Format gambar harus: JPEG, PNG, JPG, atau WebP.',
            'foto_sampah.max'      => 'Ukuran foto maksimal 5MB.',
        ];
    }
}
