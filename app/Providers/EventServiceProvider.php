<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Transfer;
use Illuminate\Support\Facades\DB;
use App\Observers\ActivityObserver;
use App\Observers\TransferObserver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionCommitting;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Activity::observe(ActivityObserver::class);

        Transfer::observe(TransferObserver::class);

        DB::listen(fn($query) => File::append(storage_path('/logs/query.log'), '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL));

        Event::listen(function (TransactionBeginning $event) {
            File::append(storage_path('/logs/query.log'), '[' . date('Y-m-d H:i:s') . '] Transaction Begin' . $event->connectionName . PHP_EOL . PHP_EOL);
        });

        Event::listen(function (TransactionCommitting $event) {
            File::append(storage_path('/logs/query.log'), '[' . date('Y-m-d H:i:s') . '] Transaction Comitting ' . $event->connectionName. PHP_EOL . PHP_EOL);
        });

        Event::listen(function (TransactionCommitted $event) {
            File::append(storage_path('/logs/query.log'), '[' . date('Y-m-d H:i:s') . '] Transaction Commited ' . $event->connectionName. PHP_EOL . PHP_EOL);
        });

        Event::listen(function (TransactionRolledBack $event) {
            File::append(storage_path('/logs/query.log'), '[' . date('Y-m-d H:i:s') . '] Transaction Relled Back ' . $event->connectionName. PHP_EOL . PHP_EOL);
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
