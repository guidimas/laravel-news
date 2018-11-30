<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    // Soft Deletes
    use SoftDeletes;

    protected $fillable = [
        'comment', 'attachment',
    ];

    protected $hidden = [
        'attachment',
    ];

    // News
    public function news() {
        // Many-to-One
        return $this->belongsTo('App\News');
    }

    // User
    public function user() {
        // Many-to-One
        return $this->belongsTo('App\User');
    }

    // Soft Deletes
    protected $dates = ['deleted_at'];
    
    // Table name
    protected $table = 'comments';
}
