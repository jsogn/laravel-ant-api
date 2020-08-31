<?php

namespace App\Listeners;

use App\Events\HandleLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use App\Repositories\Models\HandleLog;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLogListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param HandleLogEvent  $event
     * @return void
     */
    public function handle(HandleLogEvent $event)
    {
       HandleLog::create($event->log);
    }
}
