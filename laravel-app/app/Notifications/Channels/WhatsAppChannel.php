<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppChannel
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        try {
            $message = $notification->toWhatsAppMessage($notifiable);

            // Remove non-numeric characters
            $phoneNumber = preg_replace('/\D/', '', $notifiable->player->phonenumber);
            
            // Add country code if not present
            if (!str_starts_with($phoneNumber, '55')) {
                $phoneNumber = '55' . $phoneNumber;
            }

            $response = Http::withHeaders([
                'apikey' => config('services.whatsapp.apikey'),
            ])->post(
                config('services.whatsapp.url') . '/message/sendText/' . config('services.whatsapp.instance'),
                [
                    'number' => $phoneNumber,
                    'text' => $message['message'], 
                ]
            );

            if (!$response->successful()) {
                Log::error('WhatsApp API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

        } catch (\Exception|\Throwable $e) {
            Log::error('WhatsApp Notification Error: ' . $e->getMessage());
        }
    }
}