<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log; // Tambahkan Log untuk debugging

class CurrencyService
{
    // Mengubah nama method agar sesuai dengan pemanggilan sebelumnya
    // dan memastikan logikanya robust.
    public static function getRate(string $from, string $to): float
    {
        // Jika mata uang sama, tidak perlu panggil API
        if ($from === $to) {
            return 1.0;
        }

        $cacheKey = "currency_rate_{$from}_{$to}";
        $apiKey = config('services.exchangerates.key');

        // Jika API Key tidak ada, berikan nilai default untuk menghindari error
        if (!$apiKey) {
            Log::error('Exchange Rates API Key not found in .env file.');
            return self::getFallbackRate($from, $to);
        }

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($from, $to, $apiKey) {
            $response = Http::get('https://api.exchangeratesapi.io/v1/latest', [
                'access_key' => $apiKey,
                'symbols' => "{$from},{$to}" // Optimasi: hanya minta simbol yang kita butuhkan
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // API gratis exchangeratesapi.io menggunakan EUR sebagai base
                if (isset($data['rates'][$from]) && isset($data['rates'][$to])) {
                    // Kalkulasi cross-rate: (rate EUR ke TO) / (rate EUR ke FROM)
                    return $data['rates'][$to] / $data['rates'][$from];
                }
            }
            
            // Jika API gagal atau data tidak valid, catat error dan gunakan fallback
            Log::warning('Failed to fetch currency conversion from API.', [
                'from' => $from,
                'to' => $to,
                'response_status' => $response->status(),
                'response_body' => $response->body(),
            ]);

            return self::getFallbackRate($from, $to);
        });
    }

    /**
     * Menyediakan nilai tukar default jika API gagal.
     */
    private static function getFallbackRate(string $from, string $to): float
    {
        if (($from === 'IDR' && $to === 'USD')) {
            // Asumsi 1 USD = 16,400 IDR
            return 1 / 16400; // sekitar 0.00006
        }
        
        if (($from === 'USD' && $to === 'IDR')) {
            return 16400.0;
        }

        return 1.0; // Default jika pasangan tidak dikenali
    }
}