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
            'name.required' => "Ime je obavezno polje!",
            'expiration_date.after' => "Rok dokumenta mora biti datum u budućnosti!",
            'file_path.mimes' => "Fajl može biti formata pdf, docx!",
            'is_folder.required' => 'Morate odabrati tip podatka!'
        ];
    }

    public function createRules(){
        return [
            'name' => 'required',
            'parent_id' => 'nullable|numeric',
            'is_folder' => 'required',
            'file_path' => 'nullable|mimes:pdf, docx',
            'expiration_date' => 'nullable|after:today',
            'sector_id' => 'nullable',
            'type_id' => 'nullable'
        ];
    }

    public function updateRules(){
        return [
            'name' => 'required',
            'parent_id' => 'nullable|numeric',
            'is_folder' => 'required',
            'expiration_date' => 'nullable|after:today',
            'file_path' => 'nullable|mimes:pdf, docx',
            'sector_id' => 'nullable',
            'type_id' => 'nullable'
        ];
    }

}
