<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    public function health(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'service' => 'devops-dashboard-api',
            'timestamp' => now()->toIso8601String(),
        ]);
    }

    public function ready(): JsonResponse
    {
        $environment = env('APP_ENV', 'development');

        // Simulate readiness rules
        $ready = match ($environment) {
            'production' => true,
            'staging' => true,
            default => true,
        };

        return response()->json([
            'ready' => $ready,
            'environment' => $environment,
        ], $ready ? 200 : 503);
    }
}
