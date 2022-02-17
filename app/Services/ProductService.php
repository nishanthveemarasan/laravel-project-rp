<?php

namespace App\Services;

use App\Contracts\ProductContract;
use App\Models\Product;
use App\Services\CommonService;

class ProductService extends CommonService implements ProductContract
{

    /**
     * index
     *
     * @return void
     */
    public function index($row)
    {
        return Product::withTrashed()->paginate($row);
    }

    /**
     * store
     *
     * @param  array $data
     * @return array
     */
    public function store($data, $imageUrl)
    {

        $product = Product::firstOrCreate(
            ['name' => $data['name']],
            ['price' => $data['price'], 'offer_price' => $data['offerPrice']]
        );


        $product->images()->firstOrCreate([
            'path' => $imageUrl
        ]);

        $product->description()->firstOrCreate([
            'description' => $data['description']
        ]);

        $product->colors()->sync($data['color']);

        $product->heights()->sync($data['height']);

        return 'product has been created successfully!!';
    }

    /**
     * edit
     *
     * @param  Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        return $product;
    }
}
