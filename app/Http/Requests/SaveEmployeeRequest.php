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



        ];
    }

    public function updateRules(){
        return [

        ];
    }

}
