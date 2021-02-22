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
            'image.required' => 'Morate unijeti fotografiju!',
            'image.max' => 'Maksimalna veličina fotografije je 5mb!',
            'image.mimes' => 'Fotografija može biti formata: jpeg,png,jpg,gif,svg!',
            'home_address.required' => 'Morate unijeti adresu!',
            'jmbg.required' => 'Morate unijeti JMBG!',
            'email.required' => 'Morate unijeti E-mail!',
            'pid.required' => 'Morate izabrati nadređenog!',
            'gender.required' => 'Morate izabrati pol!',
            'city_id.required' => 'Morate izabrati grad!',
            'birth_date.required' => 'Morate unijeti datum rođenja!',

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
            'image' => 'required|max:5000|mimes:jpeg,png,jpg,gif,svg',
            'pid' => 'nullable',
            'gender' => 'required',
            'additional_info_contact' => 'nullable',
            'mobile_number' =>'nullable',
            'telephone_number'=>'nullable',
            'additional_info'=>'nullable',
            'office_number'=>'nullable',
            'city_id'=>'required',
        ];
    }

    public function updateRules(){
        return [

            'name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date_format:d.m.Y.',
            'qualifications' => 'nullable',
            'home_address' => 'required',
            'jmbg' => 'required',
            'email' => 'required',
            'pid' => 'nullable',
            'gender' => 'nullable',
            'image' => 'nullable|max:5000|mimes:jpeg,png,jpg,gif,svg',
            'additional_info_contact' => 'nullable',
            'mobile_number' =>'nullable',
            'telephone_number'=>'nullable',
            'additional_info'=>'nullable',
            'office_number'=>'nullable',
            'city_id'=>'required'
        ];
    }

}
