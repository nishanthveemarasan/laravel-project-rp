<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    protected $with = ['user'];

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
}
