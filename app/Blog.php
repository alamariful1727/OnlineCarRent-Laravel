<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Table Name
    protected $table = 'blogs';
    // Primary Key
    public $primaryKey = 'bid';
    // Timestamps
    public $timestamps = true;
    const CREATED_AT = 'blog_created_at';
    const UPDATED_AT = 'blog_updated_at';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
