<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PeliculaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|max:250|min:2',
            'anio' => 'required',
            'duracion' => 'required|max:500',
            'sinopsis' => 'required|max:250',
            'imagen' => 'nullable|image',
            'actorPrincipalID' => 'nullable'
        ];
    }
}
