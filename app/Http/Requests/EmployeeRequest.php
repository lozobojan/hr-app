<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        return $this->is('employees/store') ? $this->createRules() : $this->updateRules();
    }

    public function messages()
    {
        return [

            'name.required'=> 'Morate unijeti Ime',
            'last_name.required'=> 'Morate unijeti Prezime',

        ];
    }

    public function createRules(){
        return [

            'name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date_format:d.m.Y.',
            'image_path' => 'nullable',
            'qualifications' => 'nullable',
            'home_address' => 'required',
            'jmbg' => 'required',
            'email' => 'required',
        ];
    }

    public function updateRules(){
        return [

            'name' => 'required',
            'last_name' => 'required',
        ];
    }

}
