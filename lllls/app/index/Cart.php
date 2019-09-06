<?php

namespace App\index;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'cart_id';
    protected $table = 'cart';
    public $timestamps = false;
    protected $fillable = [
    	'banner_name',
    	'banner_sort',
    	'banner_id',
    	'banner_num',
    	'u_id',
    	'is_del',
    ];
}
