<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\InscriptionValidation;



class AuthenticationController extends Controller
{
    public function register(Request $request, InscriptionValidation $validation)
    {
        $validator = Validator::make($request->all(), $validation->rules(), $validation->messages() );
        
        if($validator->fails()){
            return response()->json(['erreur'=> $validator->errors()]);   
        };

        $user=User::create([
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'password'=>bcrypt($request->input('password')),
            'api_token'=>$random = Str::random(60),
        ]);
        
        return response()->json($user);
    }

    public function login(Resquest $request){
        if(Auth::attempt(['email' => $request->input('email'), 'password'=>$request->input('password')])){
            $user = User::where('email', $request->input('email'))->firstOrFail();
            return response()->json($user);
        }else{
            return response()->json(['erreur'=>'Indentifiants inccorrects !']);
        }
    }
}

