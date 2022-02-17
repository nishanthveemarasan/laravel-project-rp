<?php

namespace App\Contracts;

use App\Models\Product;

interface ProductContract
{

    /**
     * index
     *
     * @return void
     */
    public function index($row);


    /**
     * store
     *
     * @param  array $data
     * @param  string $imageUrl
     * @return array
     */
    public function store($data, $imageUrl);

    /**
     * edit
     *
     * @param  Product $product
     * @return array
     */
    public function edit(Product $product);
}
