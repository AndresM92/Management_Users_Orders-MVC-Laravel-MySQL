<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\GenerMascota;
use Illuminate\Validation\Rules\Enum;


class MascotaRequest extends FormRequest
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
        $id = $this->route('mascota');

        $rules = [
            'name_pet' => ['required', 'string', 'max:30'],
            'specie' => ['required', 'string', 'max:20'],
            'breed' => ['required', 'string', 'max:15'],
            'gener' => ['required', new Enum(GenerMascota::class)],
            'date_birth' => ['required', 'date_format:Y-m-d'],
            'medical_history' => ['nullable', 'string', 'max:5000'],
            'imagen' => [$method === 'POST' ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'N_cellphone' => ['required', 'string', 'max:13'],
            'address' => ['required', 'string', 'max:50'],
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name_pet.required' => 'El nombre de la mascota es obligatorio.',
            'name_pet.max' => 'El nombre de las mascota no puede tener más de 30 caracteres.',

            'specie.required' => 'La especie de la mascota es obligatorio.',
            'specie.max' => 'La especie de la mascota no debe contener mas de 20 caracteres.',

            'gener.required' => 'El genero de la mascota es obligatorio.',

            'breed.required' => 'La raza de la mascota es obligatorio.',
            'breed.max' => 'La raza no puede tener más de 30 caracteres.',

            'date_birth.required' => 'La fecha de nacimiento de la mascota es obligatorio.',
            'date_birth.date' => 'Formato de fecha invalido debe ser: Y-m-d',

            'medical_history.max' => 'La descripción no puede tener mas de 5000 caracteres.',

            'imagen.required' => 'La imagen de la mascota es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo JPG o PNG.',
            'imagen.max' => 'La imagen no debe de pesar mas de 2MB.',

            'name.required' => 'El nombre del dueño es obligatorio.',
            'name.max' => 'El nombre del dueño no puede tener más de 30 caracteres.',

            'email.required' => 'El campo correo es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
        ];
    }
}
