<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogHandler
{
    /**
     * Log general info messages.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logInfo(string $message, array $context = [])
    {
        Log::info($message, $context);
    }

    /**
     * Log warning messages.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logWarning(string $message, array $context = [])
    {
        Log::warning($message, $context);
    }

    /**
     * Log error messages.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logError(string $message, array $context = [])
    {
        Log::error($message, $context);
    }
}
