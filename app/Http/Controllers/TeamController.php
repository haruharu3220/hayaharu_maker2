<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\User;



class TeamController extends Controller
{
    //
    
    protected $teamModel;

    
    public function create(){
        
        return view('team.team');
    }
    
    public function register(Request $request){
        
        // dd($request->familyID);
        // dd(Auth::id());
        // バリデーションルールを定義
        // $rules = [
        //     'made_id' => ['required', 'unique:teams'],
        // ];

        // バリデーションチェックを実行
        //  $request->validate($rules);

        // チームを登録
        // $team = Team::create([
        //     'made_id' => $request->familyID,
        // ]);
        $teams = new team();
        $teams -> made_id = $request -> familyID;
        $teams ->save();
        
        
        // ログインしているユーザーの team_id を更新
        $user = User::find(Auth::id());
        $user->team_id = $teams->id;
        $user->save();
        
        // ダッシュボードにリダイレクト
        return redirect()->route('dashboard');
    }
}

