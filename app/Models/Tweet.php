<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;
    
    
    // $guardedでアプリケーション側でcreateなどできない値を設定
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

}
