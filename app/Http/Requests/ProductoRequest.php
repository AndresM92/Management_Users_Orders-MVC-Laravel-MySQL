<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{

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
        $method = $this->method();
        $id = $this->route('producto');

        $rules = [
            'codigo' => ['required', 'string', 'max:16', 'unique:productos,codigo,' . $id],
            'nombre' => ['required', 'string', 'max:100'],
            'precio' => ['required', 'numeric', 'min:0'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'imagen' => [$method === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
        return $rules;
    }

    public function messasges(): array
    {
        return [
            'codigo.required' => 'El codigo del producto es obligatorio.',
            'codigo.unique' => 'Este codigo ya esta registrado en otro producto.',
            'codigo.max' => 'el codigo no puede tener más de 50 caracteres.',

            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'precio.required' => 'el precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser negativo.',

            'descripion.max' => 'La descripción no puede tener mas de 1000 caracteres.',

            'imagen.required' => 'La imagen del producto es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo JPG o PNG.',
            'imagen.max' => 'La imagen no debe de pesar mas de 2MB.',
        ];
    }
}
