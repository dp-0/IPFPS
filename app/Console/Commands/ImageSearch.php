<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImageSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ipfs:ImageSearch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the venv for python and install the required packages for face recognization';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->isPythonInstalled()) {
            $this->error('Python is not installed on this system.');
            return;
        }

        $venvPath = "python/v1";
        exec("python3 -m venv $venvPath", $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error('Failed to create the virtual environment.');
            return;
        }

        $activateScript = "source " . $venvPath . (DIRECTORY_SEPARATOR === '\\' ? '\Scripts\activate' : '/bin/activate');
        $activateCommand = $activateScript . ' && ';
        $requirementsFile = base_path('python/v1/src/requirements.txt');

        $installCommand = "pip install -r $requirementsFile";
        $fullCommand = $activateCommand . $installCommand;
        exec($fullCommand, $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error('Failed to install Python packages.');
            return;
        }

        $this->info('Python virtual environment and packages installed.');
    }
    protected function isPythonInstalled()
    {
        exec('python3 --version', $output, $returnCode);
        return $returnCode === 0;
    }
}
