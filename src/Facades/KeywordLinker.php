<?php

namespace The3LabsTeam\KeywordLinker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \The3LabsTeam\KeywordLinker\KeywordLinker
 */
class KeywordLinker extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \The3LabsTeam\KeywordLinker\KeywordLinker::class;
    }
}
