<?php

namespace App\Service;

use DateTime;
use DateTimeZone;
use Symfony\Component\HttpClient\HttpClient;

class NasaApi
{

    public function randImage(): string
    {
        $client = HttpClient::create();

        $yearsRand = rand(1, 10);
        $date = (new DateTime('', new DateTimeZone('Europe/Paris')))->modify('-' . $yearsRand . ' year');
        $link = 'https://api.nasa.gov/mars-photos/api/v1/rovers/opportunity/photos?earth_date=';
        $response = ($client->request('GET', $link . $date->format('Y-m-d') . '
        &camera=NAVCAM&api_key=' . NASA_KEY))->toArray()['photos'];


        while (empty($response)) {
            $yearsRand = rand(1, 10);
            $date = (new DateTime('', new DateTimeZone('Europe/Paris')))->modify('-' . $yearsRand . ' year');
            $response = $client->request('GET', $link . $date->format('Y-m-d') . '
            &camera=NAVCAM&api_key=' . NASA_KEY)->toArray()['photos'];
        }

        $totalPhotos = count($response);

        return $response[rand(0, $totalPhotos - 1)]['img_src'];
    }
}
