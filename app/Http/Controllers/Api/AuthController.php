<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(AuthRequest $request)
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Credentials'
            ], 422);
        }

        $permissions = auth()->user()->hasAnyRole('admin', 'moderator') ? ['full'] : ['read'];
        $token = auth()->user()->createToken($request->device_name ?? 'api', $permissions);

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $token->plainTextToken
            ]
        ]);
    }
}
