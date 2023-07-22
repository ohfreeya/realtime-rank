<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $currentPage = 'dashboard';
        return view('dashboard', compact('currentPage'));
    }

    public  function getRankData()
    {
        set_time_limit(0);
        $data = [
            ["team" => "A", "score" => rand(0, 100)],
            ["team" => "B", "score" => rand(0, 100)],
            ["team" => "C", "score" => rand(0, 100)],
        ];
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
        return response()->json($teamList);
    }
}
