<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\UserScore;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
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
    // delete team
    public function deleteTeam($id)
    {
        $team = Team::find($id);
        if ($team) {
            $team->delete();
        }
        return redirect(Route('teams.page'))
            ->with('result', 0)
            ->with('message', 'Delete successfully.');
    }
    // get score page
    public function getScorePage()
    {
        $currentPage = 'score';
        $isStaff = Auth::user()->isStaff;
        $teamList = Team::whereNot('id', 1)->get();
        return view('score', compact('currentPage', 'isStaff', 'teamList'));
    }
    // get selected team's current score
    public function getSelectedTeamScore($team_id)
    {
        $team = Team::find($team_id);
        return response()->json([
            "score" => $team->score
        ], 200);
    }
    // store score
    public function storeScore(Request $request)
    {
        $input = $request->all();
        $validator_data = [
            "team" => "required",
            "score" => "required",
        ];
        $validator = validator::make($input, $validator_data);
        if ($validator->fails()) {
            return back()
                ->with('result', 1)
                ->with('message', "All Fields are required"); // field required
        }
        $team = Team::find($input['team']);
        $team->score = $team->score + $input['score'];
        $team->save();

        UserScore::create([
            "user_id" => 1,
            "team_id" => $team->id,
            "score_record" => $input['score'],
        ]);

        Redis::set($team->name, $team->score);
        return redirect(Route('score.page'))
            ->with('result', 0)
            ->with('message', 'Modify successfully');
    }
}
