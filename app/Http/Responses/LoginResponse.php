<?php

namespace App\Http\Responses;


class LoginResponse
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (in_array($user->role, ['admin', 'super_admin'])) {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/dashboard');
    }
}