<?php

namespace App\Services;

class FileService
{
    /**
     * @param  string  $pathToFolderOne
     * @param  string  $pathToFolderTwo
     * @return null
     */
    public function getSameFiles(string $pathToFolderOne, string $pathToFolderTwo)
    {
        $filesInFolderOne = $this->getFiles($pathToFolderOne);
        $filesInFolderTwo = $this->getFiles($pathToFolderTwo);

        return array_intersect($filesInFolderOne, $filesInFolderTwo);
    }

    /**
     * Get all filename in a directory.
     *
     * @param  string  $pathToFolderOne
     * @return array
     */
    private function getFiles(string $pathToFolderOne): array
    {
        $files = [];

        // Check if absolute or relative path (both Windows and Linux)
        if (strpos($pathToFolderOne, ':') === 1 || str_starts_with($pathToFolderOne, '/')) {
            $pathToFolderOne = realpath($pathToFolderOne);
        } else {
            $pathToFolderOne = realpath(base_path($pathToFolderOne));
        }

        // Check if folder exists
        if (!is_dir($pathToFolderOne)) {
            return $files;
        }

        foreach (scandir($pathToFolderOne) as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $files[] = $file;
        }

        return $files;
    }
}
