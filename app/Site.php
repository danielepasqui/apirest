<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'url', 'doc_root', 'auth_name', 'auth_pass', 'cms_admin', 'cms_pass', 'pm', 'group', 'notes', 'technology_id', 'machine_id', 'customer_id'];
	
	/**
	 * Get the machine of the sites.
	 */
	public function machine()
	{
		return $this->belongsTo('App\Machine');
	}
	
	/**
	 * Get the customer of the sites.
	 */
	public function customer()
	{
		return $this->belongsTo('App\Customer');
	}
	
	/**
	 * Get the Technology of the sites.
	 */
	public function technology()
	{
		return $this->belongsTo('App\Technology');
	}
	
	 /**
     * The databases that belong to the site.
     */
    public function database()
    {
        return $this->belongsToMany('App\Database', 'sites_databases', 'site_id', 'database_id');
    }
}
