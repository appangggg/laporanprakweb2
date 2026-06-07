<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|string|unique:categories,name'
        ];
    }

    public function messages() {
        return [
            'name.unique' => 'Nama kategori sudah ada.'
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