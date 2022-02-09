<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'price', 'category_id', 'image'];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function orders(){
        return $this->hasMany('App\Order');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function category(){
        return $this->belongsTo('App\Category');
    }
    
    public function likedUsers(){
        return $this->belongsToMany('App\User', 'likes');
    }
    
    public function isLikeBy($user){
        $liked_users_ids = $this->likedUsers->pluck('id');
        $result = $liked_users_ids->contains($user->id);
        return $result;
    }
    
    public function isSoldOut(){
        return $this->orders->count() > 0;
    }
    
}
