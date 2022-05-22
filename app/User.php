<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Traits\Viewable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Viewable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password', 'master_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }

    public function team_members() {
        return $this->hasMany('App\Team_Member');
    }
}
