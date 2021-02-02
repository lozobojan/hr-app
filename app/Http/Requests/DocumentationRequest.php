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
        if($this->is_folder == 1){
            return $this->createFolder();
        }
        else if($this->is('directory/create')){
            return $this->createFile();
        }
        else{
            return $this->updateFile();
        }
    }

    public function messages()
    {
        return [
            'name.required' => "Ime je obavezno polje!",
            'parent_id.numeric' => 'Parent folder mora biti numerička vrijednost!',
            'is_folder.required' => 'Morate odabrati tip podatka!',
            'file_path.required' => 'Morate unijeti fajl!',
            'file_path.mimes' => 'Fajl može biti formata pdf ili docx',
            "expiration_date.required" => "Morate unijeti rok!",
            'expiration_date.after' => "Rok dokumenta mora biti datum u budućnosti!"
        ];
    }

    public function createFolder()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable|numeric',
            'is_folder' => 'required',
            'file_path' => 'nullable',
            'expiration_date' => 'nullable',
            'sector_id' => 'nullable',
            'type_id' => 'nullable'
        ];
    }


    public function createFile()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable|numeric',
            'is_folder' => 'required',
            'file_path' => 'required|mimes:pdf, docx',
            'expiration_date' => 'required|after:today',
            'sector_id' => 'nullable',
            'type_id' => 'nullable'
        ];
    }

    public function updateFile(){
        return [
            'name' => 'required',
            'parent_id' => 'nullable|numeric',
            'is_folder' => 'required',
            'file_path' => 'nullable|mimes:pdf, docx',
            'expiration_date' => 'required|after:today',
            'sector_id' => 'nullable',
            'type_id' => 'nullable'
        ];
    }

}
