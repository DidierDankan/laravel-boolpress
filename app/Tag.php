<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //relazione fra tabelle Tag->post
    public function Posts() {
        return $this->belongsToMany('App\Post');
    }
}
