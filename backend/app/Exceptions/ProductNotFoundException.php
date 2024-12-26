<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductNotFoundException extends Exception
{
    protected $productId;

    public function __construct($productId, $message = 'Product not found.')
    {
        parent::__construct($message);
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Báo cáo lỗi (report).
     */
    public function report(): void
    {
        // Ghi log lỗi
        logger()->warning('Product not found', ['product_id' => $this->getProductId()]);

        // Ghi nhận lỗi vào Pulse (nếu Pulse được cấu hình)
        if (app()->bound('pulse')) {
            app('pulse')->recordException($this);
        }
    }

    /**
     * Hiển thị lỗi (render).
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => [
                'status' => 404,
                'message' => $this->getMessage(),
                'product_id' => $this->getProductId(),
            ]
        ], 404);
    }
}
