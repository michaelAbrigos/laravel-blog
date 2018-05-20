<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $fillable = [
        'img_path', 'user_id'
    ];

    public static $rules = array(
		'img_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	);
	
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
