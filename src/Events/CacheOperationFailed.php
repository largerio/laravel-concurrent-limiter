<?php

declare(strict_types=1);

namespace Largerio\LaravelConcurrentLimiter\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Throwable;

class CacheOperationFailed
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Request|null  $request  The HTTP request (null for job context)
     * @param  Throwable  $exception  The exception that occurred
     */
    public function __construct(
        public ?Request $request,
        public Throwable $exception
    ) {}
}
