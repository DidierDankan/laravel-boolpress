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
        'content',
        'cover'
    ];

    /**
     * relazione fra tabelle
     * posts->categories
     */

     public function category() {
         return $this->belongsTo('App\Category');
     }

     /**
      * relazione fra tabelle
      * Tag ->Post
      */
      public function Tags() {
          return $this->belongsToMany('App\Tag');
      }
}
