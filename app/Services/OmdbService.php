<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OMDB_API_KEY'); // Make sure to set this in your .env file
    }

    public function search($query)
    {
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => $this->apiKey,
            's' => $query,
        ]);

        return $response->json();
    }

    public function getDetails($id)
    {
        $response = Http::get('http://www.omdbapi.com/', [
            'apikey' => $this->apiKey,
            'i' => $id,
        ]);

        return $response->json();
    }
}
