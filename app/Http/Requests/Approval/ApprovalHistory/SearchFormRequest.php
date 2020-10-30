<?php

namespace App\Http\Requests\Approval\ApprovalHistory\Approval\ApprovalHistory\Approval\ApprovalHistory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchFormRequest extends FormRequest
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
        return [
            'code' => 'required',
            'form_id' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail(422, '参数错误!', $validator->errors()->all(), 422)));
    }
}
