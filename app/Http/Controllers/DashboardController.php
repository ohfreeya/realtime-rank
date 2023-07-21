<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public  function getRankData()
    {
        $data = [
            ["team" => "A", "score" => rand(0, 100)],
            ["team" => "B", "score" => rand(0, 100)],
            ["team" => "C", "score" => rand(0, 100)],
        ];
        uasort($data, function ($a, $b) {
            if ($a == $b) return 0;
            return ($a < $b) ? -1 : 1;
        });

        return response()->json($data);
    }
    public function getRankTeamList()
    {
        $teamList =  ["A", "B", "C"];
        return response()->json($teamList);
    }
}
