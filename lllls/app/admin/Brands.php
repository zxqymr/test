<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
	const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $primaryKey = 'brand_id';
    protected $table = 'brand';
    public $timestamps = false;
    protected $fillable = [
        'brand_name',
        'brand_url',
        'brand_desc',
        'brand_logo',
    ];
}
