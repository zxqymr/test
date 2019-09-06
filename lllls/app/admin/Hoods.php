<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Hoods extends Model
{
    protected $primaryKey = 'hood_id';
    protected $table = 'hood';
    public $timestamps = false;
    protected $fillable = [
    	'hood_img',
    	'hood_name',
    	'hood_tel',
    	'hood_title',
    	'hood_office',
    	'age_name',
    	'hood_city',
    	'hood_label',
    	'hood_count',
    	'hood_time',
    	'hood_number',
    	'hood_desc',
    	'audit_status',
    	'is_recommend',
    ];
}
