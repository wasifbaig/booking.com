<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require 'WeatherApi.php';


final class WeatherApiTest extends TestCase
{
    protected $weatherApi;

    protected function setUp(): void
    {
        parent::setUp();
        $this->weatherApi = new WeatherApi();
    }

    public function testWeatherEmptyCityName(): void
    {
        $this->assertSame('City name is required.', $this->weatherApi->getWeatherByCityName(''));
    }


    public function testWeatherWrongyCityName(): void
    {
        $this->assertSame('City name is not valid.', $this->weatherApi->getWeatherByCityName('1122'));
    }

    public function testWeatherCityNotFound(): void
    {
        $this->assertSame('city not found', $this->weatherApi->getWeatherByCityName('sdsdsds'));
    }

    public function testWeatherCityFound(): void
    {
        $this->assertIsString($this->weatherApi->getWeatherByCityName('Berlin'));
    }


}
