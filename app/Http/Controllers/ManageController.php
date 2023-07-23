<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManageController extends Controller
{
    // get manger page
    public function index()
    {
        $currentPage = 'teams';
        $isStaff = Auth::user()->isStaff;
        $teamsList = Team::whereNot('id', 1)->pluck('name', 'id')->toArray();
        return view('teams', compact('currentPage', 'isStaff', 'teamsList'));
    }

    // create a new team
    public function createTeam(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "name" => "required",
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back()
                ->with('result', 1)
                ->with('message', "All Fields are required"); // field required
        }
        $checkTeamName = Team::where('name', $input['name'])->first();
        if ($checkTeamName) {
            return back()
                ->with('result', 1)
                ->with('message', "This name is already used.");
        }
        Team::create([
            "name" => $input['name'],
            "score" => 0
        ]);

        return redirect(Route('teams.page'))
            ->with('result', 0)
            ->with('message', 'Create successfully.');
    }
}
