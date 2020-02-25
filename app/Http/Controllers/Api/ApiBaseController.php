<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\LogLevel;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Auth;

class ApiBaseController extends Controller
{
     /**
     * @param $code
     * @param $message
     * @param $status
     * @param $logLevel
     * @return JsonResponse
     */
    protected function sendError($code, $message, $status, $logLevel = LogLevel::ERROR): JsonResponse
    {
        // Log context
        $context = $this->getContext($code);

        if ($logLevel == LogLevel::DEBUG) {
            Log::debug($message, $context);
        } elseif ($logLevel == LogLevel::INFO) {
            Log::info($message, $context);
        } elseif ($logLevel == LogLevel::WARNING) {
            Log::warning($message, $context);
        } elseif ($logLevel == LogLevel::ERROR) {
            Log::error($message, $context);
        } elseif ($logLevel == LogLevel::ALERT) {
            Log::alert($message, $context);
        }

        $response = [
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ];

        return response()->json($response, $status);
    }

     /**
     * Get log context.
     *
     * @param $code
     * @return array
     */
    private function getContext($code = null): array
    {
        if ($code) {
            return $context = [
                'code' => $code,
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'input' => request()->all(),
            ];
        }

        return $context = [
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'input' => request()->all(),
            ];
    }
}
