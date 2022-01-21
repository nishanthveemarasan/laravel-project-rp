<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string)Str::orderedUuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
