<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table = 'buyers';

    public function contract() {
        return $this->belongsTo('App\Contract');
    }
}
