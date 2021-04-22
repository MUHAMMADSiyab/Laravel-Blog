<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
    ];

    protected $appends = [
        'formatted_date',
    ];

    protected $with = ['user'];
    /**
     * Checks whether the user trying to edit/delete the comment is the one who created it
     * @param App\Models\Post $post
     * @return bool
     */
    public static function checkPosterIdentity(Comment $comment): bool
    {
        if (!auth()->user()->is_admin) {
            if ($comment->user_id !== auth()->id()) {
                return false;
            }

            return true;
        }
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedDateAttribute()
    {
        return  $this->created_at->format('M d, Y h:i:s A');
    }
}
