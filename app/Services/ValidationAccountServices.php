<?php


namespace App\Services;


use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Http;

class ValidationAccountServices
{




    public function validateAccount()
    {
        try {
            $response = Http::get( 'https://docs.guzzlephp.org/123123123123123123/123123123');
//            $response = Http::get( 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6/asdasdasdas');
            return $response;
        } catch (ClientException $e) {
            throw new \Exception($e->getRequest());
            throw new \Exception($e->getResponse());
        }
    }

}
