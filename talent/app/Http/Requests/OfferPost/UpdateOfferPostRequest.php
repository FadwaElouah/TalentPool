<?php

namespace App\Http\Requests\OfferPost;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferPostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'salary' => 'nullable|numeric|min:0',
            'deadline' => 'required|date|after:today',
            'is_active' => 'boolean'
        ];
    }
}
