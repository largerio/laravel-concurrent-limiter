<?php

declare(strict_types=1);

namespace Largerio\LaravelConcurrentLimiter\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when a request starts waiting for a slot.
 */
class ConcurrentLimitWaitStarted
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Request  $request  The HTTP request
     * @param  int  $currentCount  Current number of concurrent requests
     * @param  int  $maxParallel  Maximum allowed parallel requests
     * @param  string  $key  The cache key used for this limiter
     */
    public function __construct(
        public Request $request,
        public int $currentCount,
        public int $maxParallel,
        public string $key
    ) {}
}
