<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->is('documentation/create') ? $this->createRules() : $this->updateRules();
    }

    public function messages()
    {
        return [
            'name.required' => "Ime je obavezno polje!"
        ];
    }

    public function createRules(){
        return [
            'name' => 'required',
            'parent_id' => 'numeric',
            'is_folder' => 'required',
            'file_path' => 'nullable',
        ];
    }

    public function updateRules(){
        return [
            'name' => 'required',
            'parent_id' => 'numeric',
            'is_folder' => 'required',
            'file_path' => 'nullable',
        ];
    }

}
