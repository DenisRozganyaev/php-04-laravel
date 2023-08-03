<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Orders\Created\AdminNotification;
use App\Notifications\Orders\Created\CustomerNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class OrderCreatedNotifyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Order $order)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logs()->info(self::class);
//        $this->order->notify(app()->make(CustomerNotification::class));
        Notification::send(User::role('admin')->get(), app()->make(AdminNotification::class));
    }
}
