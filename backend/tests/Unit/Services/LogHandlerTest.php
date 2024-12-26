<?php

namespace Tests\Unit\Services;

use App\Services\LogHandler;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LogHandlerTest extends TestCase
{
    /**
     * Test logInfo method logs an info message.
     */
    public function testLogInfo()
    {
        // Arrange
        Log::shouldReceive('info')
            ->once()
            ->with('Test info message', ['key' => 'value']);

        // Act
        LogHandler::logInfo('Test info message', ['key' => 'value']);

        // Assert
        $this->assertTrue(true); // Confirm the mock expectation is met
    }

    /**
     * Test logWarning method logs a warning message.
     */
    public function testLogWarning()
    {
        // Arrange
        Log::shouldReceive('warning')
            ->once()
            ->with('Test warning message', ['key' => 'value']);

        // Act
        LogHandler::logWarning('Test warning message', ['key' => 'value']);

        // Assert
        $this->assertTrue(true); // Confirm the mock expectation is met
    }

    /**
     * Test logError method logs an error message.
     */
    public function testLogError()
    {
        // Arrange
        Log::shouldReceive('error')
            ->once()
            ->with('Test error message', ['key' => 'value']);

        // Act
        LogHandler::logError('Test error message', ['key' => 'value']);

        // Assert
        $this->assertTrue(true); // Confirm the mock expectation is met
    }
}
