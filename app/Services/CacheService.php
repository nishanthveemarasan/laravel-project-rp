<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\CommonService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CacheService extends CommonService
{
    public function checkCacheItem($key)
    {
        return Cache::has($key) ?? false;
    }

    public function getCacheItem($key)
    {
        return Cache::get($key);
    }

    public function storeCacheItem($key, $data, $expireTime = 30)
    {
        $expireAt = Carbon::now()->addMinutes($expireTime);
        Cache::put($key, $data, $expireAt);
    }

    public function getCacheIndex($array, $uuid)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]['uuid'] == $uuid) {
                return $i;
            }
        }
        return -1;
    }

    public function clearCacheItem($key)
    {
        Cache::forget($key);
    }

    public function addCacheCartItem($cartExists, $cacheItem, &$cart)
    {
        if ($cartExists) {
            $cart = $this->getCacheItem('cart_order');
            $itemIndex = $this->getCacheIndex($cart, $cacheItem['uuid']);
            if ($itemIndex != -1) {
                $cart[$itemIndex]['count'] += 1;
                $cart[$itemIndex]['totalPrice'] += $cacheItem['unitPrice'];
                $cart[$itemIndex]['totalDiscount'] += $cacheItem['discount'];
            } else {
                $cacheItem['totalPrice'] = $cacheItem['unitPrice'];
                $cacheItem['totalDiscount'] = $cacheItem['discount'];
                $cart[] = $cacheItem;
            }
        } else {
            $cacheItem['totalPrice'] = $cacheItem['unitPrice'];
            $cacheItem['totalDiscount'] = $cacheItem['discount'];
            $cart[] = $cacheItem;
        }
    }

    public function removeCacheCartItem($cartExists, $cacheItem, &$cart, $uuid = null)
    {
        if ($cartExists) {
            $cart = $this->getCacheItem('cart_order');
            $cartItemUuid = $uuid ?? $cacheItem['uuid'];

            $itemIndex = $this->getCacheIndex($cart, $cartItemUuid);
            if ($itemIndex != -1) {
                if ($uuid) {
                    array_splice($cart, $itemIndex, 1);
                } else {
                    $count = $cart[$itemIndex]['count'] -= 1;
                    if ($count > 0) {
                        $cart[$itemIndex]['totalPrice'] -= $cacheItem['unitPrice'];
                        $cart[$itemIndex]['totalDiscount'] -= $cacheItem['discount'];
                    } else {
                        array_splice($cart, $itemIndex, 1);
                    }
                }
            }
        }
    }
}
