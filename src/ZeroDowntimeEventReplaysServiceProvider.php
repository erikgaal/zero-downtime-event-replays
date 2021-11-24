<?php

namespace Gosuperscript\ZeroDowntimeEventReplays;

use Gosuperscript\ZeroDowntimeEventReplays\Commands\CreateReplay;
use Gosuperscript\ZeroDowntimeEventReplays\Commands\DeleteReplay;
use Gosuperscript\ZeroDowntimeEventReplays\Commands\EnableLiveProjection;
use Gosuperscript\ZeroDowntimeEventReplays\Commands\PutReplayLive;
use Gosuperscript\ZeroDowntimeEventReplays\Commands\ReplayCommand;
use Gosuperscript\ZeroDowntimeEventReplays\Repositories\RedisReplayRepository;
use Gosuperscript\ZeroDowntimeEventReplays\Repositories\ReplayRepository;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ZeroDowntimeEventReplaysServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('zero-downtime-event-replays')
            ->hasConfigFile()
            ->hasMigration('create_zero-downtime-event-replays_table')
            ->hasCommands(
                CreateReplay::class,
                DeleteReplay::class,
                ReplayCommand::class,
                EnableLiveProjection::class,
                PutReplayLive::class,
            );
    }

    public function register()
    {
        $this->app->bind(ReplayRepository::class, function () {
            return new RedisReplayRepository();
        });

        return parent::register(); // TODO: Change the autogenerated stub
    }
}
