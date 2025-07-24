<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public $timestamps = false;
    const UPDATEDAT = 'updatedAt';
    const CREATEDAT = 'createdAt';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'slug',
        'user_id',
        'title',
        'content',
        'cover_image',
        'status',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany{
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }
}
