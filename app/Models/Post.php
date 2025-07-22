<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $table = 'posts';
    const UPDATEDAT = 'updatedAt';
    const CREATEDAT = 'createdAt';

    // protected $fillable = [
    //     'title',
    //     'content',
    //     'cover_image',
    // ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
