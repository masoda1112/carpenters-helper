<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarpenterRequest extends FormRequest
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
            'name' => 'required',
            'img'=> 'max:2048',
            'role'=> 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => '名前を入力してください',
            'img.max' => '2MB以下のファイルを選択してください',
            'role.required'=> '職種を入力してください',
        ];
    }
}
