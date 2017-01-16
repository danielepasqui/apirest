<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    public $timestamps = false;
    protected $fillable = ['host', 'username', 'password', 'db_name'];
}
