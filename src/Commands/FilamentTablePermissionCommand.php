<?php

namespace BrayanCaro\FilamentTablePermission\Commands;

use Illuminate\Console\Command;

class FilamentTablePermissionCommand extends Command
{
    public $signature = 'filament-table-permission';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
