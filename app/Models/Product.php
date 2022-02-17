<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Image;
use App\Models\Height;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'price',
        'offer_price'
    ];

    protected $with = [
        'description',
        'images',
        'heights',
        'colors'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = (string)Str::orderedUuid();
        });
    }

    /**
     * A post has many color
     *
     * @return void
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    public function heights()
    {
        return $this->belongsToMany(Height::class, 'product_height');
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
