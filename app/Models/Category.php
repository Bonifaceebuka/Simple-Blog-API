<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    'name',
    'description',
    'banner',
    'banner_public_id'
    ];

    public function user()
        {
            return $this->belongsTo(\App\User::class,'admin_id');
        }
}
