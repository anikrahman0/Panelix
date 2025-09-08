<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PublisherValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        $emailRule = [
            'nullable',
            'email',
            'max:100',
        ];
        if (!empty($id)) {
            // update
            $emailRule[] = Rule::unique('publishers', 'email')
                ->where(fn($query) => $query->where('status', 1))
                ->ignore($id, 'id');
        } else {
            $emailRule[] = Rule::unique('publishers', 'email')
                ->where(fn($query) => $query->where('status', 1));
        }
        return [
            'title' => 'required|string|max:255',
            'email' => $emailRule,
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|integer',
        ];
    }
}
