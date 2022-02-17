<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'color'
    ];

    /**
     * A color belongs to many product
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color');
    }
}
