<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\OrderCreatedNotifyJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        OrderCreatedNotifyJob::dispatch($event->order)->onQueue('notifications')->delay(now()->addSeconds(15));
    }
}
