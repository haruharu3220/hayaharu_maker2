<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Team;

class Team extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'family_name', // 追加
        'family_id',
        'made_id',
    ];

    
     public function registerTeam(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'familyName' => ['required', 'string', 'max:255'],
            'familyID' => ['required', 'string', 'max:255'],
        ];
        
        
        // バリデーションチェックを実行
        $request->validate($rules);
        
        // 指定されたfamilyIDのレコードが存在するかチェックする
        $existingTeam = Team::where('made_id', $request->familyID)->exists();
        if ($existingTeam) {
            return redirect()->route('team.teamr')->withErrors(['familyID' => 'そのfamilyIDはすでに使用されています。別のfamilyIDを指定してください。']);
        }
        
        // dd( $request->familyID);
        // チームを登録
        $team = Team::create([
            
            'made_id' => $request->familyID
        ]);

        // ログインしているユーザのfamilyカラムに同じfamilyIDを登録する
        Auth::user()->update(['team_id' => $request->familyID]);

        return $team;
    }
    
    
}
