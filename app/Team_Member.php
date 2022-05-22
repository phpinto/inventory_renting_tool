<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team_Member extends Model
{
    protected $table = 'team_members';

    public function user() {
        return $this->belongsTo('App\User');
    }
}
