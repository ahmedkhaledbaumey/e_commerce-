<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required|string|max:255',
            "email" => 'required|email|max:255',
            "password" => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422); // Use 422 for Unprocessable Entity
        }

        // Password hash
        $password = bcrypt($request->password);

        // Generate a UUID as the access token
        $access_token = Str::uuid();

        // Create user
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "access_token" => $access_token,
        ]);

        // Return user details and access token in the response
        return response()->json([
            'success' => 'Registration successful',
            'user' => $user,
            'access_token' => $access_token,
        ], 201);
    }
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "email" => 'required|email|max:255',
    //         "password" => 'required|min:8'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors()
    //         ], 422);
    //     }

    //     $email = $request->email;
    //     $password = $request->password;
    //     $user = User::where(['email' => $email])->first();

    //     if ($user !== null) {
    //         $oldPassword = $user->password;
    //         $isVerified = Hash::check($password, $oldPassword);

    //         if ($isVerified) {
    //             $user->update([
    //                 'access_token' => Str::uuid(),
    //             ]);

    //             return response()->json([
    //                 'success' => 'You logged in successfully',
    //                 'user' => $user,  // Optionally return user details
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'error' => 'Credentials not correct',
    //             ], 401); // 401 Unauthorized for incorrect credentials
    //         }
    //     } else {
    //         return response()->json([
    //             'error' => 'This account does not exist',
    //         ], 404);
    //     }
    // }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => 'required|email|max:255',
            "password" => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Invalid email or password',
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user !== null && Hash::check($request->password, $user->password)) {
            // Optionally, you might want to use Laravel Sanctum or Passport for access token generation
            $user->update([
                'access_token' => Str::uuid(),
            ]);
            return response()->json([
                'success' => 'You logged in successfully',
                'user' => $user,  // Optionally return user details
                // 'access_token' => Str::uuid(),
            ], 200);
        } else {
            return response()->json([
                'error' => 'Invalid email or password',
            ], 401); // 401 Unauthorized for incorrect credentials
        }
    }



    public function logout(Request $request)
    {
        $access_token = $request->header("access_token");

        if ($access_token !== null && trim($access_token) !== '') {
            // Check if the access token is associated with a valid user session
            $user = User::where('access_token', $access_token)->first();

            if ($user !== null) {
                $user->update([
                    'access_token' => null
                ]);
                return response()->json([
                    'success' => 'Logout successful',
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Invalid access token',
                ], 401); // 401 Unauthorized for invalid access token
            }
        } else {
            return response()->json([
                'error' => 'Access token not provided',
            ], 400); // 400 Bad Request for missing or empty access token
        }
    }
}
