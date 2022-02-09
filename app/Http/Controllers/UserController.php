<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Http\Requests\ItemRequest;
use App\User;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\ProfileRequest;
use App\Order;

class UserController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }
    
    
    //プロフィール詳細
    public function show($id)
    {
        $user = User::find($id);
        $count = $user->items->count();
        return view('users.show', [
            'title' => 'プロフィール',
            'user' => $user,
            'count' => $count,
        ]);
        
    }


    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
    
    // 出品商品一覧
    public function exhibitions()
    {
        $items = Item::where('user_id', \Auth::user()->id)->latest()->get();
        return view('users.exhibitions', [
            'title' => '出品商品一覧',
            'items' => $items,
        ]);
    }
    
    
    // アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
}
