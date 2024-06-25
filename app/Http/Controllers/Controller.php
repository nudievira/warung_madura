<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function get(string $url, array $data)
    {
        $response = Http::withHeaders([
            // 'Authorization' => 'Bearer ' . auth()->user()->auth_key,
            'Content-Type' => 'application/json',
        ])->get(env('API_URL') . $url, $data);

        return $response;
    }

    public function post(string $url, array $data)
    {
        $response = Http::withHeaders([
            // 'Authorization' => 'Bearer ' . auth()->user()->auth_key,
            'Content-Type' => 'application/json',
        ])->post(env('API_URL') . $url, $data);
        return $response;
    }

}
