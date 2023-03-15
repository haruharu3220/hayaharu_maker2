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
        'made_id',
    ];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
