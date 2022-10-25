<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class LoginUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|exists:users,email',
            'password' => 'required|min:8'
        ];
    }

    public function handle($request, Closure $next)
    {
        Auth::attempt($request->all());
        if (Auth::attempt($request->all())) {
            $user = User::find(Auth::id());
            $token = $user->createToken('token')->plainTextToken;
            $result = $user->toArray();
            $result['access_token'] = $token;
            return $result;
        }
        return response(['message' => 'Wrong password'], Response::HTTP_UNAUTHORIZED);
    }
}
