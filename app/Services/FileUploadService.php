<?php

namespace App\Services;

use App\Repository\FileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileUploadService
{
    protected $filePath;

    protected $fileUploadRepository;

    public function __construct(FileRepository $repository)
    {
        $this->filePath = config('folders.file');
        $this->fileUploadRepository = $repository;
    }

    /**
     * Upload file to storage
     *
     * @param UploadedFile $file
     * @return File
     */
    public function uploadFile(UploadedFile $file): File
    {
        $fileName = $file->getClientOriginalName();
        $hash = $this->storeFile($file);

        return $this->fileUploadRepository->save(['filename' => $fileName, 'hash' => $hash]);
    }

    public function findAllFiles()
    {
        return $this->fileUploadRepository->findAll();
    }

    /**
     * Check if file exists in storage
     *
     * @param string $path
     * @return bool
     */
    public function fileExists(string $path): bool
    {
        return Storage::exists($this->filePath . '/' . $path);
    }

    /**
     * Get file from storage
     *
     * @param string $path
     * @return bool|string
     */
    public function getFileByPath(string $path)
    {
        if ($this->fileExists($path)) {
            return Storage::get($this->filePath . '/' . $path);
        }

        return false;
    }

    /**
     * Upload file to storage
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function storeFile(UploadedFile $file): string
    {
        $file->store($this->filePath);

        return $file->hashName();
    }
}
