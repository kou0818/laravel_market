<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Http\Requests\ItemRequest;
use App\Category;
use App\Http\Requests\ItemImageRequest;
use App\Like;
use App\Order;
use App\Http\Requests\ItemeditRequest;

class ItemController extends Controller
{
    // トップページ
    public function index()
    {
        $items = Item::where('user_id', '!=', \Auth::user()->id)->latest()->get();
        return view('items.index', [
            'items' => $items,
        ]);
    }

    // 商品新規追加
    public function create()
    {
        $categories = Category::all();
        return view('items.create', [
            'title' => '商品を出品',
            'categories' => $categories,
        ]);
    }

    // 新規追加処理
    public function store(ItemRequest $request)
    {
        // 投稿追加処理
        $path = '';
        $image = $request->file('image');
        if( isset($image) === true){
            $path = $image->store('photos', 'public');
        }
        
        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $path,
        ]);
        session()->flash('success', '投稿を追加しました');
        return redirect()->route('users.exhibitions', \Auth::user());
    }
    
    //商品詳細
    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show', [
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }

    // 商品情報編集
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all();
        return view('items.edit', [
            'title' => '商品情報の編集',
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    // 商品情報更新処理
    public function update($id, ItemeditRequest $request)
    {
        $item = Item::find($id);
        $item->update($request->only(['name', 'description', 'price', 'category_id']));
        session()->flash('success', '出品を編集しました');
        return redirect()->route('items.show', $item);
    }

    // 削除処理
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        \Session::flash('success', '出品を削除しました');
        return redirect()->route('users.exhibitions', \Auth::user());
    }
    
    // 画像変更処理
    public function editImage($id)
    {
        $item = Item::find($id);
        return view('items.edit_image', [
            'title' => '商品画像の変更',
            'item' => $item,
        ]);
    }
    
    // 画像変更処理
    public function updateImage($id, ItemImageRequest $request){
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
 
        if( isset($image) === true ){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
 
        $item = Item::find($id);
 
        // 変更前の画像の削除
        if($item->image !== ''){
          // publicディスクから、該当の投稿画像($post->image)を削除
          \Storage::disk('public')->delete(\Storage::url($item->image));
        }
 
        $item->update([
          'image' => $path, // ファイル名を保存
        ]);
 
        session()->flash('success', '画像を変更しました');
        return redirect()->route('items.show', $item);
    }
     
    // お気に入りの設定
    public function toggleLike($id){
        $user = \Auth::user();
        $item = Item::find($id);
        
        if($item->isLikeBy($user)){
            // お気に入りの取り消し
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', '');
        } else {
            // お気に入りの設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', '');
        }
        return redirect('/items');
    }
    
    public function confirm($id){
        
        $item = Item::find($id);
        return view('items.confirm', [
            'item' => $item,
        ]);
    }
    
    public function finish($id){
        
        $item = Item::find($id);
        
        Order::create([
            'user_id' => \Auth::user()->id,
            'item_id' => $id,
        ]);
        
        return view('items.finish', [
            'title' => 'ご購入ありがとうございました。',
            'item' => $item,
        ]);
    }
    
    // アクセス制限
    public function __construct()
    {
        $this->middleware('auth');
    }
}
