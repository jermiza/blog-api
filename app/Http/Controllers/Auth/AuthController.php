<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * User authorization.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function logIn(LoginRequest $request)
    {
        if (! Auth::attempt($request->validated(), $request->input('remember'))) {
            return response(
                [
                    'message' => trans('Incorrect Data'),
                ],
                422
            );
        }

        return response([
            'message' => trans('Successful Login'),
            'access_token' => Auth::user()->createToken('API Token')->plainTextToken,
        ], 200);
    }

    /**
     * User log out.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function logOut(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();

        return response([
            'message' => trans('Successful Logout '),
        ], 200);
    }
}
