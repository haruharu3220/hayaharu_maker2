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

    // 更新日時が新しい順にソートしてデータを表示する．
    // self は Tweet モデルのこと．
    // orderBy() は SQL のものと同じ理解で OK．
    // 最後の get() がないと実行されないので注意．
    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
    
    
    //1(tweet)対多(Photo)のデータ連携
    public function tweetPhotos(){
        return $this->hasMany(Photo::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
  
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
  
}
