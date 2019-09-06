<?php

namespace App\admin;

use Illuminate\Database\Eloquent\Model;

class Newss extends Model
{
    protected $primaryKey = 'news_id';
    protected $table = 'news';
    public $timestamps = false;
    protected $fillable = [
    	'news_title',
    	'cate_name',
    	'news_major',
    	'is_show',
    	'news_author',
    	'author_email',
    	'keyword',
    	'web_desc',
    	'news_logo',
    ];

}
