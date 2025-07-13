<?php

namespace App\Http\Requests\Category; // This MUST match the folder structure

use Illuminate\Foundation\Http\FormRequest;

class MyNewCategoryRequest extends FormRequest // This MUST match the file name (without .php)
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required | min:5 | max:500',
            'slug' => 'required | min:5 | max:500 | unique:posts', // Note: unique:posts suggests this is for posts, not categories
        ];
    }
}