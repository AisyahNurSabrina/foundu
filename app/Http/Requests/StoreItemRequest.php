<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'pickup_point_id' => ['required', 'exists:pickup_points,id'],
            'location_found' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama barang wajib diisi.',
            'description.required' => 'Deskripsi barang wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'pickup_point_id.required' => 'Titik pengambilan wajib dipilih.',
            'pickup_point_id.exists' => 'Titik pengambilan tidak valid.',
            'location_found.required' => 'Lokasi penemuan wajib diisi.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Foto harus format JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
