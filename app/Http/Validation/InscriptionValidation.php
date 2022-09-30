<?php

namespace App\Http\Validation;


class InscriptionValidation{

    public function rules(){
        return [
            'name'=>['string', 'required', 'max:150', 'min:2'],
            'email'=>['string', 'required', 'max:150', 'min:3', 'unique:users' ],
            'email'=>['string', 'required', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Vous devez entrer votre nom',
            'email.required'=>'Vous devez entrer votre email',   
            'email.unique'=>'Cet email est deja pris',
            'password.min' => 'Votre mot doit contenir au moins 8 caractères',
            'confirm_password.same' => 'votre mot de passe et votre mot de passe de confirmation ne doivent pas etres different',         
        ];
    }



}