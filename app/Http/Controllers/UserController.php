<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // register
    public function storeRegister(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm" => "required"
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back(); // field required
        }
        if ($input['confirm'] !== $input['password']) {
            return back(); // confirm and password is different
        }
        $checkEmail = User::where('email', $input['email'])->first();
        if ($checkEmail) {
            return back(); // email already registered
        }
        unset($input['confirm']);
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return redirect('login', 302); // register successfully
    }

    // after login
    public function loginAuth(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "email" => "required",
            "password" => "required",
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back(); // field required
        }
        $user = User::where('email', $input['email'])->first();
        if (Auth::attempt($input)) {
            $token = $user->createToken('token-' . $user->id)->plainTextToken;
            session('token', $token);
            return response()->json([
                "message" => "Login successful",
                "token" => $token
            ], 200);
        }

        return response()->json([
            "message" => "Login failed",
        ], 200);
    }

    // get user profile page
    public function getProfile()
    {
        $currentPage = 'profile';
        return view('profile', compact('currentPage'));
    }
}