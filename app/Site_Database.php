<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site_Database extends Model
{
	protected $table = 'sites_databases';
	protected $primaryKey = 'id';
    public $timestamps = false;
}
