<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $table = 'sellers';

    public function contract() {
        return $this->belongsTo('App\Contract');
    }
}
