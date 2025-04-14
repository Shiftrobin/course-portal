<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusRequest extends FormRequest
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
        if(isset($this->id)){
            return [
                    'name' => 'required:campus|max:200,'.$this->id,
            ];
        }
        return [
            'name' => 'required'
        ];
    }
}
