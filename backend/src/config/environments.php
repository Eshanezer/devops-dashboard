<?php

return [
    'development' => [
        'status' => 'healthy',
        'ci_pipeline' => 'running',
        'uptime_min' => 100,
        'uptime_max' => 1000,
    ],

    'staging' => [
        'status' => 'degraded',
        'ci_pipeline' => 'failed',
        'uptime_min' => 500,
        'uptime_max' => 5000,
    ],

    'production' => [
        'status' => 'healthy',
        'ci_pipeline' => 'passed',
        'uptime_min' => 10_000,
        'uptime_max' => 100_000,
    ],
];
