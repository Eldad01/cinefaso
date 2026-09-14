<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Envoie un SMS via l'API Orange SMS.
     *
     * Tant que SMS_API_KEY n'est pas configuré (développement, ou avant obtention
     * des identifiants Orange), le message est simplement journalisé au lieu d'être
     * envoyé — aucun risque d'appel réseau accidentel en local ou pendant les tests.
     */
    public function send(string $telephone, string $message): void
    {
        $apiKey = config('services.orange_sms.api_key');
        $endpoint = config('services.orange_sms.endpoint');

        if (! $apiKey || ! $endpoint) {
            Log::info("[SMS simulé] À {$telephone} : {$message}");

            return;
        }

        // À adapter au format exact de l'API Orange SMS (Burkina Faso) une fois
        // les identifiants obtenus : https://developer.orange.com/apis/sms
        Http::withToken($apiKey)->post($endpoint, [
            'sender' => config('services.orange_sms.sender'),
            'to' => $telephone,
            'message' => $message,
        ]);
    }
}
