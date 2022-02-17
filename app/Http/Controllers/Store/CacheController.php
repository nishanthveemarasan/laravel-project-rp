<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Services\StoreService;
use App\Http\Controllers\Controller;
use App\Services\CacheService;
use App\Services\ResponseService;

class CacheController extends Controller
{
    /**
     * $responseService instance
     *
     * @var mixed
     */
    public $responseService;

    /**
     * cacheService instance
     *
     * @var mixed
     */
    public $cacheService;

    public function __construct(CacheService $cacheService, ResponseService $responseService)
    {
        $this->cacheService = $cacheService;
        $this->responseService = $responseService;
    }

    public function addCacheCartItem(Request $request)
    {
        $cart = [];
        $cartExists = $this->cacheService->checkCacheItem('cart_order');
        $cacheItem = $request->all();

        $this->cacheService->addCacheCartItem($cartExists, $cacheItem, $cart);
        $this->cacheService->storeCacheItem('cart_order', $cart);

        return $this->responseService->result();
    }

    public function removeCacheCartItem(Request $request, $uuid = null)
    {
        $cart = [];
        $cartExists = $this->cacheService->checkCacheItem('cart_order');
        $cacheItem = $request->all();

        $this->cacheService->removeCacheCartItem($cartExists, $cacheItem, $cart, $uuid);

        $this->cacheService->storeCacheItem('cart_order', $cart);
        return $this->responseService->result();
    }

    public function orderCart()
    {
        $cart = $this->cacheService->getCacheItem('cart_order') ?? [];
        return $this->responseService->result($cart);
    }

    public function deleteCart()
    {
        $this->cacheService->clearCacheItem('cart_order');
        $this->cacheService->clearCacheItem('cart_customer');
        return $this->responseService->result();
    }

    public function cacheCustomer(Request $request)
    {
        $customerData = $request->all();
        $this->cacheService->storeCacheItem('cart_customer', $customerData);
        return $this->apiResponseService->success(200, array());
    }

    public function getCacheCustomer()
    {
        $cart = $this->cacheService->getCacheItem('cart_customer') ?? [];
        return $this->responseService->result($cart);
    }
}
