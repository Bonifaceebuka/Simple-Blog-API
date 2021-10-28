<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'admin_id',
        'poster',
        'poster_public_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
	}

	public function user(){
        return $this->belongsTo(\App\User::class,'admin_id');
    }
    
}
