<?php

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

if (!function_exists('sendWhatsapp')) {
    function sendWhatsapp(string $to, string $message): bool
    {
        try {
           
            $to = str_starts_with($to, 'whatsapp:')
                ? $to
                : 'whatsapp:' . $to;

            $from = config('services.twilio.whatsapp_from');

         
            if ($to === $from) {
                throw new Exception('WhatsApp TO and FROM cannot be the same.');
            }

            $twilio = new Client(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );

            $twilio->messages->create($to, [
                'from' => $from,
                'body' => $message,
            ]);

            return true;

        } catch (\Throwable $e) {
            Log::error('WhatsApp send failed', [
                'to' => $to ?? null,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}

