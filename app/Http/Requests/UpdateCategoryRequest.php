<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $id = $this->route('category');
        return [
            'name' => "required|string|unique:categories,name,{$id}"
        ];
    }
}