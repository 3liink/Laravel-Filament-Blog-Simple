<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'cover',
        'status',
        'user_id'
    ];
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tags_blog');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
