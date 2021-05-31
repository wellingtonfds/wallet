<?php


namespace App\Services;

use App\Exceptions\ValidationAccountException;
use Illuminate\Support\Facades\Http;

class ValidationAccountServices
{

    /**
     * @return array|mixed
     * @throws ValidationAccountException
     */
    public function validateAccount()
    {
        $response = Http::get(env('API_VALIDATION_ACCOUNT'));
        if ($response->status() === 200) {
            $body = $response->json();
            if ($this->validateMessage($body)) {
                return  $body;
            } else {
                throw new ValidationAccountException();
            }
        }
        throw new ValidationAccountException();
    }

    private function validateMessage($data): bool
    {
        if (isset($data['message'])) {
            if ($data['message'] == 'Autorizado') {
                return  true;
            }
            return false;
        }
        return false;
    }
}
