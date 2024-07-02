<?php

namespace The3LabsTeam\KeywordLinker\Commands;

use Illuminate\Console\Command;

class KeywordLinkerCommand extends Command
{
    public $signature = 'laravel-keyword-linker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
