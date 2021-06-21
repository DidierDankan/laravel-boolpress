<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    protected $fillable = [
        'title',
        'category_id',
        'slug',
        'content'
    ];

    /**
     * definire relazione categories
     * posts->categories
     */

     public function category() {
         return $this->belongsTo('App\Category');
     }
}
