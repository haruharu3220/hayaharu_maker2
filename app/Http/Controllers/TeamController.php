<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;


class TeamController extends Controller
{
    //
    
    protected $teamModel;

    
    public function create(){
        
        return view('team.team');
    }
    
    public function register(Request $request){
        $team = new Team;
        
        $user = Auth::user();
        // $team = Team::registerTeam($request);
        // dd($team->family_name);
        // ddd($request);
        $a = $team->registerTeam($request);
        return view('dashboard');
    }
}
