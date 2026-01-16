<?php

declare(strict_types=1);

namespace Largerio\LaravelConcurrentLimiter\Metrics;

use Illuminate\Events\Dispatcher;
use Largerio\LaravelConcurrentLimiter\Contracts\MetricsCollector;
use Largerio\LaravelConcurrentLimiter\Events\CacheOperationFailed;
use Largerio\LaravelConcurrentLimiter\Events\ConcurrentLimitExceeded;
use Largerio\LaravelConcurrentLimiter\Events\ConcurrentLimitReleased;
use Largerio\LaravelConcurrentLimiter\Events\ConcurrentLimitWaitStarted;

class MetricsEventSubscriber
{
    public function __construct(
        protected MetricsCollector $collector
    ) {}

    public function handleWaitStarted(ConcurrentLimitWaitStarted $event): void
    {
        $this->collector->incrementWaitingTotal($event->key);
    }

    public function handleExceeded(ConcurrentLimitExceeded $event): void
    {
        $this->collector->incrementExceededTotal();
        $this->collector->recordWaitTime($event->waitedSeconds);
    }

    public function handleReleased(ConcurrentLimitReleased $event): void
    {
        $this->collector->incrementRequestsTotal();
    }

    public function handleCacheFailure(CacheOperationFailed $event): void
    {
        $this->collector->incrementCacheFailuresTotal();
    }

    /**
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            ConcurrentLimitWaitStarted::class => 'handleWaitStarted',
            ConcurrentLimitExceeded::class => 'handleExceeded',
            ConcurrentLimitReleased::class => 'handleReleased',
            CacheOperationFailed::class => 'handleCacheFailure',
        ];
    }
}
