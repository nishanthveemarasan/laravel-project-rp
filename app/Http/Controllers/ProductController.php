<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Services\CommonService;
use App\Services\ProductService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductCreateUpdateRequest;

class ProductController extends Controller
{
    /**
     * result
     *
     * @var mixed
     */
    private $result;

    /**
     * ProductService $productService
     *
     * @var mixed
     */
    private $productService;

    /**
     * CommonService
     *
     * @var mixed
     */
    private $commonService;

    /**
     * apiService
     *
     * @var mixed
     */
    private $apiService;

    public function __construct(ProductService $productService, ResponseService $apiService)
    {
        $this->productService = $productService;
        $this->apiService = $apiService;
    }
    public function store(ProductCreateUpdateRequest $request)
    {
        $this->authorize('create', Product::class);
        try {
            DB::beginTransaction();

            $imageUrl = $this->productService->getImageUrl($request, 'product_image', 'product_images');
            if (!$imageUrl) {
                return $this->apiService->result(['error' => 'Please Upload the right File/image'], 500);
            }

            $this->result['message'] = $this->productService->store($request->validated(), $imageUrl);

            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            $this->result['errors']['message'] = $e->getMessage();
        }
        return $this->result;
    }

    /**
     * index
     *
     * @return array
     */
    public function index($row = 10)
    {
        $this->authorize('viewAny', Product::class);
        try {
            $this->result['data'] = $this->productService->index();
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }

        return $this->result;
    }


    /**
     * edit
     *
     * @param  Product $product
     * @return array
     */
    public function edit(Product $product)
    {
        $this->authorize('view', $product);
        try {
            $this->result['data'] = $this->productService->edit($product);
        } catch (Exception $e) {
            $this->result['errors']['message'] = $e->getMessage();
            $this->code = 500;
        }
        return $this->result;
    }
}
