<?php

namespace Tests\Unit\Exceptions;

use App\Exceptions\ProductNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class ProductNotFoundExceptionTest extends TestCase
{
    /**
     * Test exception stores product ID correctly.
     */
    public function testExceptionStoresProductId()
    {
        // Arrange
        $productId = 123;

        // Act
        $exception = new ProductNotFoundException($productId);

        // Assert
        $this->assertSame($productId, $exception->getProductId());
        $this->assertSame('Product not found.', $exception->getMessage());
    }

    /**
     * Test the exception report method logs the warning.
     */
    public function testReportLogsWarning()
    {
        // Arrange
        $productId = 123;
        $exception = new ProductNotFoundException($productId);

        // Mock logger
        Log::spy();

        // Act
        $exception->report();

        // Assert
        Log::shouldHaveReceived('warning')
            ->once()
            ->with('Product not found', ['product_id' => $productId]);
    }

    /**
     * Test the exception render method returns correct JSON response.
     */
    public function testRenderReturnsJsonResponse()
    {
        // Arrange
        $productId = 123;
        $exception = new ProductNotFoundException($productId);
        $requestMock = Mockery::mock(Request::class);

        // Act
        $request = new \Illuminate\Http\Request();
        $response = $exception->render($request);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(404, $response->getStatusCode());
        $this->assertSame([
            'error' => [
                'status' => 404,
                'message' => 'Product not found.',
                'product_id' => $productId,
            ]
        ], $response->getData(true));
    }

    /**
     * Test custom message in the exception.
     */
    public function testCustomMessageInException()
    {
        // Arrange
        $productId = 123;
        $customMessage = 'Custom error message.';

        // Act
        $exception = new ProductNotFoundException($productId, $customMessage);

        // Assert
        $this->assertSame($customMessage, $exception->getMessage());
    }
}
