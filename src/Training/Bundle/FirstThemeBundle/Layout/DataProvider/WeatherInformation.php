<?php

namespace Training\Bundle\FirstThemeBundle\Layout\DataProvider;

use Guzzle\Http\Client;

class WeatherInformation
{
    const WEATHER_API_URL_PATTERN = 'https://api.openweathermap.org/data/2.5/weather?q=%s&appid=%s';

    private $apiKey = 'XXXX';

    private $city = 'Mouvaux,fr';

    /**
     * Return current weather.
     *
     * @return string
     */
    public function getCurrentWeather(): string
    {
        $client = new Client();
        $request = $client->createRequest(
            'GET',
            "http://ipinfo.io/json"
        );
        $response = $request->send();
        $json = $response->json();

        $city = $this->city;
        if ($json) {
            $city = $json['city'].','.$json['country'];
        }

        $request = $client->createRequest(
            'GET',
            sprintf(self::WEATHER_API_URL_PATTERN, $city, $this->apiKey)
        );
        $response = $request->send();
        $json = $response->json();
        if ($json) {
            return $json['weather'][0]['description'];
        }

        return 'i don\'t know';
    }
}
