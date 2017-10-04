<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewUser extends FormRequest
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
            'username'         => 'required|max:255',
            'email'            => 'required|email|unique:users',
            'password'         => ['required',
                                   'min:8',
                                   'regex:((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20})',
                                   'confirmed']
        ];
    }

    public function messages()
    {
        return [
            'email' => ['unique' => 'L\'email utente è già presente nel database, controllare anche nel cestino'],
            'password' => ['regex' => 'La password deve contenere almeno una lettera maiuscola, una lettera minuscola e un numero']
        ];
    }
}
