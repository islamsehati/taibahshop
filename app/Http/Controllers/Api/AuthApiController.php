<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Kredensial salah'], 401);
        }

        // ✅ Cek subscription partner
        $partner = $user->branch?->partner;

        if ($partner) {
            $now = now();
            $registered = $partner->registered ? \Carbon\Carbon::parse($partner->registered) : null;
            $expiresOn  = $partner->expires_on  ? \Carbon\Carbon::parse($partner->expires_on)  : null;

            $isActive = $registered && $expiresOn
                && $now->greaterThanOrEqualTo($registered)
                && $now->lessThanOrEqualTo($expiresOn);

            if (!$isActive) {
                return response()->json([
                    'message' => 'Akses ditolak. Langganan tidak aktif atau sudah berakhir. Hubungi administrator.',
                ], 403);
            }
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}