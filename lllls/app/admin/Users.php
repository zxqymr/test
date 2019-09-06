<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $primaryKey = 'user_id';
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
    	'user_name',
    	'user_pwd',
    	'user_rand',
    ];
}
