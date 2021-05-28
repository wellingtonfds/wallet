<?php


namespace App\Services;


use App\Exceptions\NotifyAccountException;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class NotifyTransactionServices
{

    public function notify(User $user)
    {
        $response = Http::get(env('API_NOTIFICATION'));
        if ($response->status() === 200) {
            $user->balance();
            return $response->json();
        }
        throw new NotifyAccountException();
    }
}
