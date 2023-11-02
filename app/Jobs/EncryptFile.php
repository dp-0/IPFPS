<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\Random;

class EncryptFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePaths;
    protected $evidence;
    private $IPFSHashes = [];
    public function __construct($filePaths, $evidence)
    {
        $this->filePaths = $filePaths;
        $this->evidence = $evidence;
    }

    public function handle(): void
    {
        $publicKey = PublicKeyLoader::load(file_get_contents(storage_path('app/public_key.pem')));
        $skey = Random::string(32);
        $iv = Random::string(16);
        $aes = new AES('cbc');
        $aes->setKey($skey);
        $aes->setIV($iv);
        $encryptedSymmetricKey = $publicKey->encrypt($skey);
        $encryptedIv = $publicKey->encrypt($iv);
        $this->IPFSHashes ['key'] = bin2hex($encryptedSymmetricKey);
        $this->IPFSHashes['iv'] = bin2hex($encryptedIv);
        foreach ($this->filePaths as $file) {
            $fileContents = file_get_contents(storage_path('app/public/' . $file));
            $encryptedFileContents = $aes->encrypt($fileContents);
            $encryptedFilePath = storage_path('app/encrypted/' . uniqid() . '.enc');
            file_put_contents($encryptedFilePath, $encryptedFileContents);
            $command = 'ipfs add ' . $encryptedFilePath;
            $output = [];
            $returnValue = 0;
            exec($command, $output, $returnValue);
            $out = trim($output[0]);
            $hash = explode(" ", $out);
            $this->IPFSHashes[] = [
                'file'=> $file ,
                'hash'=>$hash[1]
            ];
            unlink(storage_path("app/public/".$file));
            unlink($encryptedFilePath);
        }
        $this->evidence->attachment_path = json_encode($this->IPFSHashes);
        $this->evidence->save();
    }
}
