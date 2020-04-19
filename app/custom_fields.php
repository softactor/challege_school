<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use auth;

class custom_fields extends Authenticatable
{
    use Notifiable;
	
	 protected $fillable = [
        'module', 'field_label', 'field_type','created_by','updated_by'
    ];
	
	public function module()
    {
        return $this->belongsTo('App\modules','module');
    }

    public function scopeGetByUser($query, $id)
    {
		$role = getUsersRole(Auth::User()->role);
		
		if(isAdmin(Auth::User()->role))
		{
			return $query;
		
		}else{
			return $query->where('created_by', $id);
		}
        
    }
}
