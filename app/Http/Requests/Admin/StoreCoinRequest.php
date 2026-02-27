<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class StoreCoinRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'show_in_gainers' => ['nullable', 'boolean'],
            'trending_rank' => ['nullable', 'integer', 'min:1', 'max:9999'],
            'show_in_trending' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],

            'logo' => ['nullable', 'image', 'max:2048'],

            'chains.*' => ['exists:chains,id'],
            'chains' => ['required', 'array', 'min:1'],

            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'coin_type_id' => ['required', 'exists:coin_types,id'],
            'symbol' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z0-9]+$/', 'unique:coins,symbol'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}



