<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nama item wajib diisi.',
            'qty.integer' => 'Jumlah harus angka bulat.',
            'price.numeric' => 'Harga harus berupa angka.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
        ];
    }
    protected function prepareForValidation(){
    $input = $this->all();
    array_walk($input, function (&$val) {
        if (is_string($val)) {
            $val = trim(strip_tags($val));
        }
    });
    $this->merge($input);
}
}