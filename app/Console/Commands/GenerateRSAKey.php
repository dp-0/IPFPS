<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpseclib3\Crypt\RSA;

class GenerateRSAKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ipfps:generate-rsa-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Generate an RSA key pair

        $private = RSA::createKey();
        $public = $private->getPublicKey();

        file_put_contents(storage_path('app/private_key.pem'), $private);

        file_put_contents(storage_path('app/public_key.pem'), $public);

        $this->info('RSA keys generated successfully.');
    }
}
