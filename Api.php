<?php
declare(strict_types=1);

abstract class Api
{

    /**
     * @param $city string
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    abstract protected function getWeatherByCityName(string $city): string;

}