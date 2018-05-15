<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'file'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function buyers() {
        return $this->hasMany('App\Buyer');
    }

    public function sellers() {
        return $this->hasMany('App\Seller');
    }
}
