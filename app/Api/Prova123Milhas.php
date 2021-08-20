<?php


namespace App\Api;

use Illuminate\Support\Facades\Http;


class Prova123Milhas
{
    const API_BASE_URL = 'http://prova.123milhas.net/api';

    /**
     * @return array
     * @throws \Exception
     */
    public function getFlights(): array
    {
        return Http::get(self::API_BASE_URL . '/flights')->json();
    }
}
