<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Validator;
use App\Models\Tweet;
use App\Models\User;


use Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tweetフォルダのindexファイルを開く
        //Tweetモデルで作成したgetAllOrderByUpdated_at関数を実行
        $tweets = Tweet::getAllOrderByUpdated_at();;
        
        //tweetテーブルからuser_idを取得し、Userテーブルからnameを探す
        foreach ($tweets as $tweet) {
            $user = User::find($tweet->user_id);
            $tweet->user_name = $user->name;
        }

    
        //dd($tweets);
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
        
        
        // create()は最初から用意されている関数で
        //データベースに登録することができる
        // 戻り値は挿入されたレコードの情報
        // $result = Tweet::create($request->all());
        
        // dd($result);
        // dd($result->getOriginal());
        // dd($request);
        
         //フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        // $data = $request->merge(['user_id' => Auth::user()->id])->all();
        // $result = Tweet::create($data);
    
        // ルーティング「tweet.index」にリクエスト送信（一覧ページに移動）
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
        //
        $tweet = Tweet::find($id);
        return response()->view('tweet.edit', compact('tweet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $result = Tweet::find($id)->delete();
        return redirect()->route('tweet.index');
    }
}
