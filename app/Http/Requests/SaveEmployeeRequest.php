<?php

namespace App\Http\Requests;

use App\Models\EmployeeSalary;
use Illuminate\Foundation\Http\FormRequest;

class SaveEmployeeRequest extends FormRequest
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
        $formRequests = [
            EmployeeRequest::class,
            EmployeeSalaryRequest::class,
            EmployeeJobDescriptionRequest::class,
            EmployeeJobStatusRequest::class,
        ];

        $rules = [];

        foreach ($formRequests as $source) {
            $rules = array_merge(
                $rules,
                (new $source)->rules()
            );
        }

        return $rules;
    }

    public function messages()
    {
        return [

        ];
    }

    public function createRules(){
        return [

            //Employee
            'name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date_format:d.m.Y.',
            'image_path' => 'nullable',
            'qualifications' => 'nullable',
            'home_address' => 'required',
            'jmbg' => 'required',
            'email' => 'required',
            'pid' => 'nullable',
            'image' => 'nullable|max:5000|mimes:jpeg,png,jpg,gif,svg',
            'additional_info_contact' => 'nullable',
            'mobile_number' =>'nullable',
            'telephone_number'=>'nullable',
            'additional_info'=>'nullable',

            //salary
            'pay' => 'required',
            'bank_number' => 'required',
            'bonus' => 'required',
            'bank_name' => 'required',


        ];
    }

    public function updateRules(){
        return [


            //Employee
            'name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date_format:d.m.Y.',
            'image_path' => 'nullable',
            'qualifications' => 'nullable',
            'home_address' => 'required',
            'jmbg' => 'required',
            'email' => 'required',
            'pid' => 'nullable',
            'image' => 'nullable|max:5000|mimes:jpeg,png,jpg,gif,svg',
            'additional_info_contact' => 'nullable',
            'mobile_number' =>'nullable',
            'telephone_number'=>'nullable',
            'additional_info'=>'nullable',

            //salary
            'pay' => 'required',
            'bank_number' => 'required',
            'bonus' => 'required',
            'bank_name' => 'required',
        ];
    }

}
