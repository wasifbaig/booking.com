<?php
declare(strict_types=1);

require 'Api.php';
require 'vendor/autoload.php';

class WeatherApi extends Api
{
    protected $client;
    const APPID = 'c0f764ce5e4c25576b8d6325fc223810';

    public function __construct()
    {

        $this->client = new GuzzleHttp\Client(['base_uri' => 'api.openweathermap.org/data/2.5/']);
    }

    /**
     * @param string $city
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getWeatherByCity(string $city)
    {

        $response = $this->client->request(
            'GET',
            'weather',
            ['query' => ['q' => $city, 'appid' => self::APPID, 'units' => 'metric']]
        );


        return $response;

    }

    /**
     * @param string $city
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeatherByCityName(?string $city): string
    {
        try {

            $city = $city ?? null;
            if ($city == null) {
                return 'City name is required.';
            }

            if (!ctype_alpha(str_replace(' ', '', $city))) {
                return 'City name is not valid.';
            }

            $response = $this->getWeatherByCity($city);
            $city = json_decode($response->getBody()->getContents(), true);
            return current($city['weather'])['description'] . ', ' . $city['main']['temp'] . ' degrees celcius';
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(), true);
            return $response['message'];
        }
    }

}