<?php

namespace App\Http\Controllers;

use App\Models\Team;
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
            return back()
                ->with('result', 1)
                ->with('message', "All Fields are required"); // field required
        }
        if ($input['confirm'] !== $input['password']) {
            return back()
                ->with('result', 1)
                ->with('message', "Confirm password is not equal password."); // confirm and password is different
        }
        $checkEmail = User::where('email', $input['email'])->first();
        if ($checkEmail) {
            return back()
                ->with('result', 1)
                ->with('message', "Email is already exist."); // email already registered
        }
        unset($input['confirm']);
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return redirect('login', 302); // register successfully
    }
    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('login');
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
            return back()->with('result', 1)->with('message', "All Fields are required"); // field required
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
        $isStaff = Auth::user()->isStaff;
        $teamList = Team::whereNot('id', 1)->pluck('name', 'id')->toArray() ?? [];
        $user = Auth::user();
        return view('profile', compact('currentPage', 'isStaff', 'teamList', 'user'));
    }
    // modify user nickname
    public function modifyNickname(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "nickname" => "required"
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back()->with('result', 1)->with('message', "All Fields are required"); // field required
        }
        $newName = $input['nickname'];
        $user = User::find(Auth::id());
        $user->name = $newName;
        $user->save();
        return redirect(Route('profile.page'))
            ->with('message', 'Modify Successfully')
            ->with('result', 0);
    }

    // modify self team
    public function modifyTeamSelf(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "team" => "required"
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back()->with('result', 1)->with('message', "Please choose the team of you want to join."); // field required
        }
        $user = User::find(Auth::id());
        $user->team_id = $input['team'];
        $user->save();
        return redirect(Route('profile.page'))
            ->with('message', 'Modify Successfully')
            ->with('result', 0);
    }
    // User Manage Page
    public function getUserManage()
    {
        $currentPage = 'user';
        $isStaff = Auth::user()->isStaff;
        $teams = Team::all();
        $users = User::whereNot('id', 1)->orderBy('permission', 'asc')->get();
        return view('user', compact('currentPage', 'isStaff', 'teams', 'users'));
    }

    // Create user from User Manage Page
    public function createUser(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm" => "required",
            "permission" => "required",
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->with('result', 1)
                ->with('message', "All Fields are required when create user."); // field required
        }
        $checkEmail = User::where('email', $input['email'])->first();
        if ($checkEmail) {
            return back()
                ->withInput()
                ->with('result', 1)
                ->with('message', "Email already registed.");
        }
        if ($input['confirm'] !== $input['password']) {
            return back()
                ->withInput()
                ->with('result', 1)
                ->with('message', "Confirm password is not equal password.");
        }
        User::create([
            "name" => $input['name'],
            "email" => $input['email'],
            "password" => Hash::make($input['password']),
            "team_id" => $input['team'],
            "permission" => $input['permission']
        ]);
        return redirect(Route('user.page'))
            ->with('result', 0)
            ->with('message', "Created user successfully");
    }
    // delete user 
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect(Route('user.page'))
            ->with('result', 0)
            ->with('message', "Deleted user successfully");
    }
}
