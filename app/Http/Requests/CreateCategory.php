<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategory extends FormRequest
{
    protected string $className = Category::class;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can(config('permission.access.categories.publish'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:50', "unique:{$this->className}"],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', "exists:App\Models\Category,id"],
        ];
    }
}
