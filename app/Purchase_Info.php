<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase_Info extends Model
{
    protected $table = 'purchase_info';

    public function item() {
        return $this->belongsTo('App\Item');
    }
}
