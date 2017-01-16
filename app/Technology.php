<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'notes'];
}
