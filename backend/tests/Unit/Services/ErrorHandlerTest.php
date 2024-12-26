<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Services\ErrorHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ErrorHandlerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test logError logs an error message.
     */
    public function test_logError_logs_error_message()
    {
        Log::shouldReceive('error')
            ->once()
            ->with('Test Error Message', ['context' => 'test']);

        ErrorHandler::logError('Test Error Message', ['context' => 'test']);
    }

    /**
     * Test ensureTableExists when the table exists.
     */
    public function testEnsureTableExists()
    {
        // Arrange
        Schema::shouldReceive('hasTable')->with('products')->andReturn(true);

        // Act & Assert
        $this->expectNotToPerformAssertions();
        ErrorHandler::ensureTableExists('products');
    }


    /**
     * Test ensureTableExists when the table does not exist.
     */
    public function test_ensureTableExists_table_not_exists()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

        Schema::shouldReceive('hasTable')
            ->once()
            ->with('missing_table')
            ->andReturn(false);

        ErrorHandler::ensureTableExists('missing_table');
    }

    /**
     * Test abortIfEmpty aborts when data is empty.
     */
    public function test_abortIfEmpty_aborts_on_empty_data()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class);

        ErrorHandler::abortIfEmpty([], 'Data is empty', ['context' => 'test']);
    }

    /**
     * Test validateId with a valid ID.
     */
    public function testValidateIdWithValidId()
    {
        // Act & Assert
        $this->expectNotToPerformAssertions();
        ErrorHandler::validateId(123);
    }


    /**
     * Test validateId with an invalid ID.
     */
    public function test_validateId_invalid_id()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class);

        ErrorHandler::validateId('invalid-id');
    }

    /**
     * Test validateProductIds with valid product IDs.
     */
    public function testValidateProductIdsWithValidIds()
    {
        // Arrange
        Product::factory()->create(['id' => 1]);

        // Act & Assert
        $this->expectNotToPerformAssertions();
        ErrorHandler::validateProductIds(collect([1]));
    }


    /**
     * Test validateProductIds with invalid product IDs.
     */
    public function test_validateProductIds_invalid_product_ids()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

        Product::factory()->create(['id' => 1]);

        ErrorHandler::validateProductIds(collect([1, 2]));
    }

    /**
     * Test abortWithLog logs a message and aborts.
     */
    public function test_abortWithLog_logs_and_aborts()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class);

        Log::shouldReceive('warning')
            ->once()
            ->with('Test Log Message');

        ErrorHandler::abortWithLog('Test Log Message', 'Abort Message');
    }

    /**
     * Test logAndAbortServerError logs a server error and aborts.
     */
    public function test_logAndAbortServerError_logs_and_aborts()
    {
        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

        Log::shouldReceive('error')
            ->once();

        ErrorHandler::logAndAbortServerError('Server Error', 'Internal Server Error');
    }
}
