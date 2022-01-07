<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'date' => 'required',
            'message'=> 'required',
            'client'=>'required',
            'carpenters'=>'required'
        ];
    }

    public function messages(){
        return [
            'date.required' => '日付を入力してください。',
            'message.required'=> '文章を入力してください',
            'client_id.required'=>'顧客を選択してください。',
            'client_id.required'=>'職人を選択してください。',

        ];
    }
}
