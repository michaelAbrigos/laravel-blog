<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static $rules = array(
		'title' => 'required',
		'content' => 'required'
	);
	protected $fillable = [
        'title', 'content', 'slug','img_path','user_id'
    ];
    
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function comments(){

        return $this->hasMany('App\Comment');
    }
}
