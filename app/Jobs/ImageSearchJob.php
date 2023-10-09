<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImageSearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $searchImage;
    private $uuid;
    public function __construct($searchImage, $uuid)
    {
        $this->searchImage = $searchImage;
        $this->uuid = $uuid;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $activateScript = "python/v1" . (DIRECTORY_SEPARATOR === '\\' ? '\Scripts\activate' : '/bin/activate');
        $activateCommand = "source $activateScript && cd python/v1 && ";
        $command = "nohup python src/main.py ../../storage/app/public/" . $this->searchImage . " " . $this->uuid;
        $fullCommand = $activateCommand . $command . " > /dev/null 2>&1 &";
        $descriptors = [
            ['pipe', 'r'],
            ['pipe', 'w'],
            ['pipe', 'w'],
        ];
        proc_open($fullCommand, $descriptors, $pipes);
    }
}
