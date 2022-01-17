<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'name'=> ['required','string','max:100'],
            'company'=>['nullable','string','max:255'],
            'address'=> ['nullable','string','max:255'],
            'email' => ['required','email','max:255'],
            'phone' => ['required','string','max:10'],
            'password'=> ['required','string'],
        ];
    }
    public function withValidator($validator) {
        $validator->after(function($validator){
            if($validator->errors()->count()){
                if(!in_array($this->method(),['PUT','PATH'])){
                    $validator->errors()->add('post', true);
                }
            }
        });
    }
}
