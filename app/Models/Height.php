<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Height extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'height'
    ];


    /**
     * A Height belongs to many product
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_height');
    }
}
