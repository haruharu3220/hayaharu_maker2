<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Validator;
use App\Models\Tweet;
use App\Models\Tag;
use App\Models\User;


use Auth;

class TweetController extends Controller
{

    public function index()
    {
        //Tweetフォルダのindexファイルを開く
        //Tweetモデルで作成したgetAllOrderByUpdated_at関数を実行
        $tweets = Tweet::getAllOrderByUpdated_at();;
        
        //tweetテーブルからuser_idを取得し、Userテーブルからnameを探す
        foreach ($tweets as $tweet) {
            $user = User::find($tweet->user_id);
            $tweet->user_name = $user->name;
            
            $tags = Tag::where('tweet_id', $tweet->id)->get();
            $tagNames = [];
            foreach ($tags as $tag) {
                $tagNames[] = $tag->tag_name;
            }
            $tweet->tag_no = implode(',', $tagNames);
        }
        
        // dd($tweets);
        return response()->view('tweet.index',compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('tweet.create');
        

    }

    //create.blade.php から送信されていたデータは $request に入っている．
    //$request->all() とすることで全部(tweetとdescription)取得することができる．
    //フォームから送信されたデータをデータベースに保存するためのアクションである、コントローラーのstoreメソッド
    public function store(Request $request)
    {
        $tweet = new tweet();
        $tweet -> tweet = request() -> tweet;
        $tweet -> description = request() -> description;
        $tweet -> user_id = Auth::user() -> id;
        
        if(request('image')){
            $original = request()->file("image")->getClientOriginalName();
            $name = date("Ymd_His")."_".$original;
            request() ->file("image")->move("storage/image",$name);
            $tweet -> image = $name;
        }
    
        $tweet-> save();
    
        
        // バリデーション
        $validator = Validator::make($request->all(), [
            'tweet' => 'required | max:191',
            'description' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.create')
                ->withInput()
                ->withErrors($validator);
        }
        
        
        return redirect()->route('tweet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $tweet = Tweet::find($id);
        return response()->view('tweet.show', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // dd($id); ->23
        $tweet = Tweet::find($id);
        $tags = Tag::where('tweet_id', $id)->get();
        $tagNames = [];
        foreach ($tags as $tag) {
            $tagNames[] = $tag->tag_name; 
        }
        return response()->view('tweet.edit', compact('tweet','tagNames'));
    }

    
    public function update(Request $request, $id)
    {
        
        //バリデーション
        $validator = Validator::make($request->all(), [
            'tweet' => 'required | max:191',
            'description' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('tweet.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }
        
        // tag_tweetテーブルから該当tweet_idのレコードを削除
        tag::where('tweet_id', $id)->delete();
    
        // tagテーブルに新しいタグを登録
        if (!empty($request->tags)) {
            foreach ($request->tags as $tag_name) {
                $tag = new tag();
                $tag->tweet_id = $id;
                $tag->tag_name = $tag_name;
                $tag->save();
            }
        }
        
        //データ更新処理
        $result = Tweet::find($id)->update($request->all());
        return redirect()->route('tweet.index');
        // return redirect()->view('tweet.index', compact('tweet','tagNames'));    
            
    }


    public function destroy($id)
    {
        //
        $result = Tweet::find($id)->delete();
        return redirect()->route('tweet.index');
    }

    


    
}
