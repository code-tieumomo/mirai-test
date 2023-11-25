<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getSameFiles(string $pathToFolderOne, string $pathToFolderTwo)
 *
 * @see \App\Services\FileService
 */
class FileServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fileService';
    }
}
