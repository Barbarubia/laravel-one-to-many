<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    // Collegamento One-to-One con tabella users
    public function user() {
        return $this->belongsTo('App\User');
    }
}
