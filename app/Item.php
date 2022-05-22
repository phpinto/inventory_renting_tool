<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Item extends Model
{
    public function location() {
        return $this->hasOne('App\Location');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function purchase_info() {
        return $this->hasOne('App\Purchase_Info');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }

}
