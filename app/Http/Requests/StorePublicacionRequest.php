<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user_id == auth()->user()->id){
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
            'nombre' => 'required|string|max:255',
            'slug' => 'required|unique:publicaciones|string|max:255',
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];

        if($this->status == 2){
            $reglas = array_merge($reglas, [
                'categoria_id' => 'required|exists:categorias,id',
                'etiquetas' => 'required|array',
                'tema' => 'required|string|max:255',
                'contenido' => 'required|string|max:255',
            ]);
           
        }

        return $reglas;
    }
}
