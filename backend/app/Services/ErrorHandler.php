<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ErrorHandler
{
    /**
     * Log an error message.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logError($message, $context = [])
    {
        Log::error($message, $context);
    }

    /**
     * Ensure a database table exists.
     *
     * @param string $tableName
     * @return void
     */
    public static function ensureTableExists($tableName)
    {
        if (!Schema::hasTable($tableName)) {
            self::logError("Database table '{$tableName}' does not exist.");
            abort(500, "Internal Server Error: Missing table '{$tableName}'.");
        }
    }

    /**
     * Abort the request if the data is empty or null.
     *
     * @param mixed $data
     * @param string $message
     * @param array $logContext
     * @return void
     */
    public static function abortIfEmpty($data, $message, $logContext = [])
    {
        if (!$data || (is_countable($data) && count($data) === 0)) {
            Log::warning($message, $logContext);
            abort(404, $message);
        }
    }

    /**
     * Validate that an ID is numeric.
     *
     * @param mixed $id
     * @return void
     */
    public static function validateId($id)
    {
        if (!is_numeric($id)) {
            Log::warning('Invalid ID provided', ['id' => $id]);
            abort(404, 'Invalid ID provided');
        }
    }

    /**
     * Log and abort with a specific message.
     *
     * @param string $logMessage
     * @param string $abortMessage
     * @return void
     */
    public static function abortWithLog($logMessage, $abortMessage)
    {
        Log::warning($logMessage);
        abort(404, $abortMessage);
    }



    /**
     * Log and abort with a 403 Forbidden error.
     *
     * @param string $logMessage
     * @param string $abortMessage
     * @param array $context
     * @return void
     */
    public static function logAndAbortForbidden($logMessage, $abortMessage, $context = [])
    {
        Log::warning($logMessage, $context);
        abort(403, $abortMessage);
    }

    /**
     * Log a server error (500) and abort.
     *
     * @param string $logMessage
     * @param string $abortMessage
     * @return void
     */
    public static function logAndAbortServerError($logMessage, $abortMessage)
    {
        Log::error($logMessage, [
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
        ]);

        abort(500, $abortMessage);
    }
    /**
     * Validate product IDs.
     *
     * @param \Illuminate\Support\Collection $productIds
     * @return void
     */
    public static function validateProductIds($productIds)
    {
        $existingProducts = Product::whereIn('id', $productIds)->pluck('id');

        if ($existingProducts->count() !== $productIds->count()) {
            $invalidProductIds = $productIds->diff($existingProducts);
            LogHandler::logWarning('Invalid product IDs provided', [
                'invalid_product_ids' => $invalidProductIds,
                'valid_product_ids' => $existingProducts
            ]);
            abort(403, 'One or more product IDs are invalid');
        }
    }

    public static function abortIfNotFound($resource, $message, $context = [])
    {
        if (!$resource) {
            LogHandler::logWarning($message, $context);
            abort(404, $message);
        }
    }

    /**
     * Log and abort when a forbidden condition is met.
     *
     * @param bool $condition
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function abortIfForbidden($condition, $message, $context = [])
    {
        if ($condition) {
            LogHandler::logWarning($message, $context);
            abort(403, $message);
        }
    }
}
