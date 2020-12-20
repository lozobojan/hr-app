<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeJobDescriptionRequest extends FormRequest
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

            'workplace' => 'required',
            'job_description' => 'required',
            'skills' => 'required',
            'sector_id' => 'required',
        ];
    }

    public function updateRules(){
        return [
            'workplace' => 'required',
            'job_description' => 'required',
            'skills' => 'required',
            'sector_id' => 'required',
        ];
    }

}
