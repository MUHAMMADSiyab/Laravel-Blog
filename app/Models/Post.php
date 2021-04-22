<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rennokki\Rating\Contracts\Rateable;
use Rennokki\Rating\Traits\CanBeRated;

class Post extends Model implements Rateable
{
    use HasFactory, CanBeRated;

    protected $fillable = [
        'title',
        'video',
        'description',
        'user_id',
    ];

    /**
     * Checks whether the user trying to edit/delete the post is the one who created it
     * @param App\Models\Post $post
     * @return bool
     */
    public static function checkPosterIdentity(Post $post): bool
    {
        if (!auth()->user()->is_admin) {
            if ($post->user_id !== auth()->id()) {
                return false;
            }

            return true;
        }
    }

    public function getAvgRating()
    {
        return $this->averageRating(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
