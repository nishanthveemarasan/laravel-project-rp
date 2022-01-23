<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'type'
    ];

    /**
     * with
     *
     * @var array
     */
    protected $with = ['user', 'comments'];

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string)Str::orderedUuid();
        });

        self::deleting(function ($model) {
            $model->comments()->delete();
        });
    }

    /**
     * post belongs to a user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
