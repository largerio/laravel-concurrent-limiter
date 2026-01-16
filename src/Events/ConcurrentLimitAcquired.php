<?php

declare(strict_types=1);

namespace Largerio\LaravelConcurrentLimiter\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

/**
 * Dispatched when a request successfully acquires a slot.
 */
class ConcurrentLimitAcquired
{
    use Dispatchable;
    use SerializesModels;

    /**
     * @param  Request  $request  The HTTP request
     * @param  float  $waitedSeconds  Time spent waiting for a slot (0 if no wait)
     * @param  string  $key  The cache key used for this limiter
     */
    public function __construct(
        public Request $request,
        public float $waitedSeconds,
        public string $key
    ) {}
}
