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
        // Log lỗi hoặc gửi tới các dịch vụ giám sát như Sentry, Flare
        // logger()->error('Custom exception occurred', ['message' => $this->getMessage()]);
    }

    /**
     * Hiển thị lỗi (render).
     */
    public function render(Request $request): JsonResponse
    {
        // Trả về phản hồi JSON cho API
        return response()->json([
            'error' => [
                'status' => 404,
                'message' => $this->getMessage(),
                'product_id' => $this->getProductId(),
            ]
        ], 404);
    }
}
