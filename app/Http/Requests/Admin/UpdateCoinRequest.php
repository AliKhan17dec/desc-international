<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCoinRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $coinId = $this->route('coin')?->id;

        return [
            'name' => ['required','string','max:255'],
            'symbol' => ['required','string','max:20','regex:/^[A-Za-z0-9]+$/', Rule::unique('coins','symbol')->ignore($coinId)],
            'coin_type_id' => ['required','exists:coin_types,id'],
            'category_id' => ['nullable','exists:categories,id'],
            'description' => ['nullable','string'],

            'chains' => ['required','array','min:1'],
            'chains.*' => ['exists:chains,id'],

            'logo' => ['nullable','image','max:2048'],

            'is_active' => ['nullable','boolean'],
            'show_in_trending' => ['nullable','boolean'],
            'trending_rank' => ['nullable','integer','min:1','max:9999'],
            'show_in_gainers' => ['nullable','boolean'],
        ];
    }
}

