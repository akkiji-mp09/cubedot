<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [ 'user_id', 'title', 'slug', 'description', 'featured_image'];

    public function tags()
    {
    	return $this->belongsTo('App\tag', 'post_tag', 'id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
