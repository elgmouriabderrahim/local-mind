<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'location_name', 'latitude', 'longitude'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function responses() {
        return $this->hasMany(Response::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }
}
