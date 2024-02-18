<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';

    public function user(){

        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function followedUser(){
        return $this->belongsTo('App\Models\User', 'followed_user_id');
    }

}
