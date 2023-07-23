<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class DashboardController extends Controller
{
    public function index()
    {
        $currentPage = 'dashboard';
        $isStaff = Auth::user()->isStaff;
        return view('dashboard', compact('currentPage', 'isStaff'));
    }

    public  function getRankData()
    {
        set_time_limit(0);
        $data = [
            ["team" => "A", "score" => rand(0, 100)],
            ["team" => "B", "score" => rand(0, 100)],
            ["team" => "C", "score" => rand(0, 100)],
        ];
        $teams = Team::whereNot('id', 1)->pluck('name')->toArray();
        foreach ($teams as $team) {
            array_push($data, ["team" => $team, "score" => Redis::get($team) ?? 0]);
        }
        usort($data, function ($a, $b) {
            if ($a['score'] == $b['score']) return 0;
            return ($a['score'] > $b['score']) ? -1 : 1;
        });
        sleep(rand(3, 5));
        return response()->json($data);
    }
    public function getRankTeamList()
    {
        $teamList =  ["A", "B", "C"];
        $teams = Team::whereNot('id', 1)->pluck('name')->toArray();
        $teamList = array_merge($teamList, $teams);
        return response()->json($teamList);
    }
}
