<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'sid';
    public $timestamps = false;
	
	/**
	 * Get the machine of the sites.
	 */
	public function machine()
	{
		return $this->belongsTo('App\Machine', 'mid');
	}
	
	/**
	 * Get the customer of the sites.
	 */
	public function customer()
	{
		return $this->belongsTo('App\Customer', 'cid');
	}
	
	/**
	 * Get the Technology of the sites.
	 */
	public function technology()
	{
		return $this->belongsTo('App\Technology', 'tid');
	}
	
	 /**
     * The databases that belong to the site.
     */
    public function database()
    {
        return $this->belongsToMany('App\Database', 'sites_databases', 'sid', 'did');
    }
}
