<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'sometimes|required|string|max:255',
            'qty' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }

    public function messages() {
        return [
            'sometimes.required' => 'Field ini diperlukan saat diubah.',
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