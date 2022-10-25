<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;

class KhpiApiService
{
    public function __construct(private readonly Client $client)
    {
    }

    public function page1(User $user): ?array
    {
        $data = $this->getPage($user, ['page' => 1]);
        if (empty($data)) {
            return null;
        }
        return $data[0];
    }

    public function page2(User $user, int $semester): array
    {
        return $this->getPage($user, ['page' => 2, 'semestr' => $semester]);
    }

    public function page3(User $user): array
    {
        return $this->getPage($user, ['page' => 3]);
    }

    public function page4(User $user, int $semester): array
    {
        return $this->getPage($user, ['page' => 4, 'semestr' => $semester]);
    }

    public function page5(User $user, int $semester): array
    {
        return $this->getPage($user, ['page' => 5, 'semestr' => $semester]);
    }

    private function getPage(User $user, array $params)
    {
        $response = $this->client->post(config('services.khpi.api_main'), [
            'query' => array_merge($params, [
                'email' => $user->email,
                'pass' => $user->pass,
            ]),
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }
}
