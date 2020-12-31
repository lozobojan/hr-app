<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalaryRequest extends FormRequest
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

        ];
    }

    public function createRules(){
        return [

            'pay' => 'required',
            'bank_number' => 'required',
            'bonus' => 'required',
            'bank_name' => 'required',


        ];
    }

    public function updateRules(){
        return [
            'pay' => 'required',
            'bank_number' => 'required',
            'bonus' => 'required',
            'bank_name' => 'required',
        ];
    }

}
