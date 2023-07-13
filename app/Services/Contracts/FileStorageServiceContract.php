<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface FileStorageServiceContract
{
    public static function upload(UploadedFile|string $file, string $additionalPath = ''): string;

    public static function remove(string $file): void;
}
