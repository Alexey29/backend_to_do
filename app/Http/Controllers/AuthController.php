<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'massage' => $validator->errors()
            ], 401);
        }

        $formData = [
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($formData)) {
            $accessToken = Auth::user()->createToken('accessToken')->accessToken;

            return response()->json([
                'user' => Auth::user(),
                'accessToken' => $accessToken
            ], 200);
        }

        return response()->json([
            'massage' => [
                'email' => [
                    'Wrong user email or password!'
                ]
            ],
        ], 401);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        foreach (auth()->user()->tokens as $token) {
            $token->delete();
        }

        return response()->json([
            'massage' => 'user logout success',
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'massage' => $validator->errors()
            ], 401);
        }

        $formData = [
            'email'    => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];

        $newUser = User::create($formData);

        $accessToken = $newUser->createToken('accessToken')->accessToken;

        return response()->json([
            'user' => $newUser,
            'accessToken' => $accessToken
        ], 200);
    }
}
