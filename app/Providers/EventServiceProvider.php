<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\FileWasUploaded' => [
            'App\Listeners\FileWasUploaded\VerifyBatchFile',
            'App\Listeners\FileWasUploaded\AcceptBatchFile',
            'App\Listeners\FileWasUploaded\PrepareToProcessFile',
            'App\Listeners\FileWasUploaded\ProcessBatchData',
            'App\Listeners\FileWasUploaded\CompleteFileProcessing',
            'App\Listeners\FileWasUploaded\ArchiveBatchData',
        ],
        'App\Events\Teardown' => [
            'App\Listeners\Teardown\EmptyDatabase',
            'App\Listeners\Teardown\DeleteFiles',
            'App\Listeners\Teardown\ClearQueues',
            'App\Listeners\Teardown\PowerDownServers',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
