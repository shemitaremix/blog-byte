<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->usuario_id == auth()->user()->id){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
            
        $reglas = [
            'publicaciones_id' => 'required|exists:publicaciones,id',
            'usuario_id' => 'required|exists:users,id',
            'contenido' => 'required|string|max:255'
            
        ];
        
        return $reglas;
    }
}
