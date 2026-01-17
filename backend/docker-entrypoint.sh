#!/bin/sh
set -e

# If Laravel is not installed, install it once
if [ ! -f artisan ]; then
  echo "Laravel not found. Installing Laravel..."
  composer create-project laravel/laravel .
fi

# Execute the original command
exec "$@"
