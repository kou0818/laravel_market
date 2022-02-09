<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileImageRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    // プロフィール編集
    public function edit()
    {
        $user = \Auth::user();
        return view('profiles.edit', [
            'title' => 'プロフィール編集',
            'user' => $user,
        ]);
    }
    
    // プロフィール編集処理
    public function update(ProfileRequest $request)
    {
        $user = \Auth::user();
        $user->update($request->only(['name', 'profile']));
        session()->flash('success', '編集できました');
        return redirect()->route('users.show', $user);
    }

    // プロフィール画像の変更前
    public function editImage()
    {
        $user = \Auth::user();
        return view('profiles.edit_image', [
            'title' => 'プロフィール画像編集',
            'user' => $user,
        ]);
    }
    
    // プロフィール画像変更処理
    public function updateImage(ProfileImageRequest $request){
 
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
 
        if( isset($image) === true ){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
 
        $user = \Auth::user();
 
        // 変更前の画像の削除
        if($user->image !== ''){
          \Storage::disk('public')->delete(\Storage::url($user->image));
        }
 
        $user->update([
          'image' => $path, // ファイル名を保存
        ]);
 
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show', \Auth::user());
      }
    
    
    public function destroy($id)
    {
        //
    }
    
    //アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
}
