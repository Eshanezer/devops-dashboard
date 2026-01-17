<?php

namespace App\Support;

class BuildMetadata
{
    public static function get(): array
    {
        return [
            'version' => getenv('APP_VERSION', 'unknown'),
            'commit' => getenv('APP_COMMIT', 'unknown'),
            'build_time' => getenv('APP_BUILD_TIME', 'unknown'),
            'environment' => getenv('APP_ENV', 'unknown'),
        ];
    }
}
