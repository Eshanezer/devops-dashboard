<?php

namespace App\Http\Controllers;

use App\Support\BuildMetadata;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): JsonResponse{
        $service = $request->query('service','backend-api');
        $environment = $request->query('env','development');

        $envConfig = config('environments.'.$environment);
        $services = config('dashboard.services');

        if(!array_key_exists($service, $services)){
            return response()->json([
               'error' => 'Unsupported service "'.$service.'"'
            ],400);
        }

        return response()->json([
            'service' => $service,
            'environment' => $environment,
            'status' => $envConfig['status'],
            'version' => $this->resolveVersion($service),
            'uptime' => rand($envConfig['uptime_min'], $envConfig['uptime_max']),
            'ci' => config('dashboard.ci'),
            'meta'=>[
                'generated_at' => now()->toIso8601String(),
                'build' => BuildMetadata::get()
            ]
        ]);
    }

    private function resolveStatus(array|string|null $environment)
    {
        return match ($environment) {
            'production' => 'ready',
            'staging' => 'degraded',
            default => 'healthy'
        };
    }

    private function resolveVersion(string $service): string
    {
        return match ($service) {
            'frontend-app' => '1.0.0',
            'auth-service' => '0.9.2',
            default => '1.2.3',
        };
    }
}
