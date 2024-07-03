<?php

namespace The3LabsTeam\KeywordLinker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class KeywordLinkerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-keyword-linker')
            ->hasConfigFile();
        //            ->hasMigration('create_laravel-keyword-linker_table');
    }
}
