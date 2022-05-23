<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    // Collegamento One-to-Many con la tabella posts
    public function posts() {
        return $this->hasMany('App\Post');
    }
}
