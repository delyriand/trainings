<?php

namespace Training\Bundle\FirstThemeBundle\Layout\DataProvider;

class WeatherInformation
{
    /**
     * Return current weather.
     *
     * @return string
     */
    public function getCurrentWeather(): string
    {
        return 'fog';
    }
}
