<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendUploadNotification
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
    public function handle(FileUploaded $event): void
    {
        Log::info('File uploaded: ' . $event->filename);
    }
}
