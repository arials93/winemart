<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'sub_des', 'description', 'image', 'cateblog_id', 'user_id'];

    public function blog_category()
    {
        return $this->belongsTo('App\BlogCategory', 'cateblog_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
