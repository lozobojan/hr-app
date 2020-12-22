<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeJobStatusRequest extends FormRequest
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

            'type' => 'required',
            'status' => 'required',
            'date_hired' => 'required|date_format:d.m.Y.',
            'date_hired_till' => 'required|date_format:d.m.Y.',
            'additional_info' => 'required',
        ];
    }

    public function updateRules(){
        return [
            'type' => 'required',
            'status' => 'required',
            'date_hired' => 'required|date_format:d.m.Y.',
            'date_hired_till' => 'required|date_format:d.m.Y.',
            'additional_info' => 'required',
        ];
    }

}
