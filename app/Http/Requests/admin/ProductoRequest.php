<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
        $producto=$this->route()->parameter('producto');
        
        $rules = [

            'clave' => ['required', 'unique:productos', 'max:5'],
            'descripcion' => ['required', 'string', 'max:255'],
            'precioCompra' => ['required', 'numeric'],
            'precioVenta' => ['required', 'numeric'],
            'foto1' => ['image', 'max:2048']

        ];
        if($producto){
            $rules['clave']="required|unique:productos,clave,$producto->id|max:5";
            $rules['slug']="required|unique:productos,slug,$producto->id";
        }
        return $rules;
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count()) {
                if (!in_array($this->method(), ['PUT', 'PATH'])) {
                    $validator->errors()->add('post', true);
                }
            }
        });
    }
    
}
