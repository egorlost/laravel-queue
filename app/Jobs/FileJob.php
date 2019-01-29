<?php

namespace App\Jobs;

use App\Models\File;
use App\Services\FileJobService;
use App\Services\FileUploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    protected $file;

    /**
     * Create a new job instance.
     *
     * @param File $file
     * @return void
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @param FileUploadService $fileUploadService
     * @param FileJobService $fileJobService
     *
     * @return void
     */
    public function handle(FileUploadService $fileUploadService, FileJobService $fileJobService): void
    {
        $fileContent = $fileUploadService->getFileByPath($this->file['hash']);

        $result = $fileJobService->addMembers($fileContent);

        if ($result['error']) {
            $this->file['error'] = $result['error'];
            $this->file['status'] = File::STATUS_ERROR;
        } else {
            $this->file['status'] = File::STATUS_COMPLETED;
        }

        $this->file['members'] = $result['members'];
        $this->file['treated_members'] = $result['treated_members'];
        $this->file['time_processing'] = now();

        $this->file->save();
    }
}
