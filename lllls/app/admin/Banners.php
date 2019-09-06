<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    const CREATED_AT = 'create_time';
	const UPDATED_AT = 'update_time';
    protected $primaryKey = 'banner_id';
    protected $table = 'banner';
    public $timestamps = false;
    protected $fillable = [
    	'banner_name',
    	'banner_url',
    	'banner_img',
    	'banner_status',
    	'banner_sort',
    ];
}
