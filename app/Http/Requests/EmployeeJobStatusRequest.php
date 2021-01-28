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
            'type.required' => 'Morate izabrati tip zaposlenja!',
            'status.required' => 'Morate izabrati status zaposlenja!',
            'date_hired.required' => 'Morate izabrati datum zaposlenja!',
            'date_hired_till.required' => 'Morate izabrati datum važenja zaposlenja!',
        ];
    }

    public function createRules(){
        return [

            'type' => 'required',
            'status' => 'required',
            'date_hired' => 'required',
            'date_hired_till' => 'required',
            'additional_info' => 'nullable',
        ];
    }

    public function updateRules(){
        return [
            'type' => 'required',
            'status' => 'required',
            'date_hired' => 'required',
            'date_hired_till' => 'required',
            'additional_info' => 'nullable',
        ];
    }

}
