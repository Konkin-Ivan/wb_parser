<?php

namespace App\Parser;

use GuzzleHttp\Client;

class RemoteDataFetcher
{

    public function fetchData()
    {
        $responseFile = './response.json';

        if (file_exists($responseFile)) {
            $data = file_get_contents($responseFile);
        } else {
            $client = new Client();
            $response = $client->get('https://catalog.wb.ru/brands/v2/catalog', [
                'query' => [
                    'appType' => '1',
                    'brand' => '27445',
                    'curr' => 'rub',
                    'dest' => '-1257786',
                    'sort' => 'popular',
                    'limit'=> '100',
                    'spp' => '30'
                ],
                'headers' => [
                    'Accept'             => '*/*',
                    'Accept-Language'    => 'ru,en;q=0.9',
                    'Connection'         => 'keep-alive',
                    'Origin'             => 'https://www.wildberries.ru',
                    'Referer'            => 'https://www.wildberries.ru/brands/msi',
                    'Sec-Fetch-Dest'     => 'empty',
                    'Sec-Fetch-Mode'     => 'cors',
                    'Sec-Fetch-Site'     => 'cross-site',
                    'User-Agent'         => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
                    'sec-ch-ua'          => '"Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
                    'sec-ch-ua-mobile'   => '?0',
                    'sec-ch-ua-platform' => '"Linux"'
                ]
            ]);

            $data = $response->getBody();

            file_put_contents($responseFile, $data);
        }

        return json_decode($data, true);
    }
}