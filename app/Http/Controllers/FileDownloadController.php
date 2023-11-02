<?php

namespace App\Http\Controllers;

use App\Jobs\DecryptFile;
use App\Models\Evidence;
use Illuminate\Http\Request;
use phpseclib3\Crypt\AES;
use phpseclib3\Crypt\RSA;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Response;
class FileDownloadController extends Controller
{
    protected $evidence;
    public function download(Request $request,$hash, $id){
        $this->evidence = Evidence::where('id',$id)->first();
        $attachmentPaths  = json_decode($this->evidence->attachment_path, true);
        $privateKey = RSA::load(file_get_contents(storage_path('app/private_key.pem')));
        $decryptedIv = $privateKey->decrypt(hex2bin($attachmentPaths['iv']));
        $symmetricKey = $privateKey->decrypt(hex2bin($attachmentPaths['key']));
        $aes = new AES('cbc');
        $aes->setKey($symmetricKey);
        $aes->setIV($decryptedIv);
        unset($attachmentPaths['key']);
        unset($attachmentPaths['iv']);
        $client = new Client();
        $url = 'http://127.0.0.1:5001/api/v0/cat';

        $fileName = 'ipfs';
        foreach($attachmentPaths as $file){
            if($file['hash'] == $hash){
                $fileName= basename($file['file']);
            }
        }
        $response = $client->post($url, [
            'query' => [
                'arg' => $hash,
            ],
        ]);
        $file = $response->getBody()->getContents();
        $fileLocation = storage_path('app/encrypted/'. 'abc.txt');
        $decryptedData = $aes->decrypt($file);
        file_put_contents($fileLocation, $decryptedData, LOCK_EX);
        return Response::download($fileLocation, $fileName, ['Content-Type: application/zip']);
    }
}
