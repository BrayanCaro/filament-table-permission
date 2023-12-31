<?php

namespace BrayanCaro\FilamentTablePermission;

use BrayanCaro\FilamentTablePermission\Commands\FilamentTablePermissionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTablePermissionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-table-permission')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-table-permission_table')
            ->hasCommand(FilamentTablePermissionCommand::class);
    }
}
