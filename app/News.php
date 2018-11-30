<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    // Soft Deletes
    use SoftDeletes;

    protected $fillable = [
        'title', 'lead', 'image', 'body',
    ];

    // User
    public function user() {
        // Many-to-One
        return $this->belongsTo('App\User');
    }

    // Comments
    public function comments() {
        // One-to-Many
        return $this->hasMany('App\Comment');
    }

    // Soft Deletes
    protected $dates = ['deleted_at'];

    // Table name
    protected $table = 'news';
}
