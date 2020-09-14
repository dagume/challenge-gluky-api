<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $table= 'posts';

    protected $primaryKey = 'id';

    public $timestamps = false;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image',
        'description',
        'post_date',
    ];

    
}
