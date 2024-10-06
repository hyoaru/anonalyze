<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function sign_up(Request $request){
        return 'sign-up';
    }

    public function sign_in(Request $request){ 
        return 'sign-in';
    }

    public function sign_out(Request $request){
        return 'sign-out';
    }
}
