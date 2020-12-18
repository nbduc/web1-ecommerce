<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // you don't need else here as you are already returning
        // if the previous condition is true
        if(Auth::user()->hasRole('admin')) {
            return redirect(route('admin.users.index'));
        }

        return redirect('/');
        
        // return $request->wantsJson()
        //             ? response()->json(['two_factor' => false])
        //             : redirect()->intended(config('fortify.home'));
    }

}