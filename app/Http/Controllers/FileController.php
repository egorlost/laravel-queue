<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\FileJobService;
use App\Services\FileUploadService;

class FileController extends Controller
{
    protected $fileUploadService;

    protected $fileJobService;

    public function __construct(FileUploadService $fileUploadService, FileJobService $fileJobService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->fileJobService = $fileJobService;
    }

    public function index()
    {
        return view('home');
    }

    public function files()
    {
        $files = $this->fileUploadService->findAllFiles();

        return view('files', compact('files'));
    }

    public function store(FileRequest $request)
    {
        $file = $this->fileUploadService->uploadFile($request->file('file'));

        $this->fileJobService->addToQueue($file);

        return view('home');
    }
}
