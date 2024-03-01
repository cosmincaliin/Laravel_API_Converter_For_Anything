use Tests\TestCase;

<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Http\Controllers\ConvertLengthController;
use App\Http\Controllers\ConvertSpeedController;
use App\Http\Controllers\ConvertTemperatureController;
use App\Http\Controllers\ConvertVolumeController;
use App\Http\Controllers\ConvertWeightController;

class ConvertControllersTest extends TestCase
{
    // ConvertLengthController tests
    public function testConvertLengthController()
    {
        $controller = new ConvertLengthController();
        $response = $controller->__invoke(5, 'meters');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(16.4042, $result['result']);

        $response = $controller->__invoke(10, 'feet');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(3.048, $result['result']);

        $response = $controller->__invoke('abc', 'meters');
        $response->assertJson(['error' => 'The value must be numeric'])
            ->assertStatus(400);

        $response = $controller->__invoke(10, 'invalid_unit');
        $response->assertJson(['error' => 'Unrecognized unit'])
            ->assertStatus(400);
    }

    // ConvertSpeedController tests
    public function testConvertSpeedController()
    {
        $controller = new ConvertSpeedController();
        $response = $controller->__invoke(100, 'kilometers');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(62.1371, $result['result']);

        $response = $controller->__invoke(60, 'miles');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(96.5604, $result['result']);

        $response = $controller->__invoke('abc', 'kilometers');
        $response->assertJson(['error' => 'El valor debe ser numérico'])
            ->assertStatus(400);

        $response = $controller->__invoke(50, 'invalid_unit');
        $response->assertJson(['error' => 'Unidad no reconocida'])
            ->assertStatus(400);
    }

    // ConvertTemperatureController tests
    public function testConvertTemperatureController()
    {
        $controller = new ConvertTemperatureController();
        $response = $controller->__invoke(100, 'celsius');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(212, $result['result']);

        $response = $controller->__invoke(212, 'fahrenheit');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(100, $result['result']);

        $response = $controller->__invoke('abc', 'celsius');
        $response->assertJson(['error' => 'El valor debe ser numérico'])
            ->assertStatus(400);

        $response = $controller->__invoke(50, 'invalid_unit');
        $response->assertJson(['error' => 'Unidad no reconocida'])
            ->assertStatus(400);
    }

    // ConvertVolumeController tests
    public function testConvertVolumeController()
    {
        $controller = new ConvertVolumeController();
        $response = $controller->__invoke(10, 'liters');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(2.64172, $result['result']);

        $response = $controller->__invoke(5, 'gallons');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(18.927, $result['result']);

        $response = $controller->__invoke('abc', 'liters');
        $response->assertJson(['error' => 'El valor debe ser numérico'])
            ->assertStatus(400);

        $response = $controller->__invoke(50, 'invalid_unit');
        $response->assertJson(['error' => 'Unidad no reconocida'])
            ->assertStatus(400);
    }

    // ConvertWeightController tests
    public function testConvertWeightController()
    {
        $controller = new ConvertWeightController();
        $response = $controller->__invoke(10, 'kilograms');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(22.0462, $result['result']);

        $response = $controller->__invoke(5, 'pounds');
        $result = json_decode($response->getContent(), true);

        $this->assertEquals(2.26796, $result['result']);

        $response = $controller->__invoke('abc', 'kilograms');
        $response->assertJson(['error' => 'El valor debe ser numérico'])
            ->assertStatus(400);

        $response = $controller->__invoke(50, 'invalid_unit');
        $response->assertJson(['error' => 'Unidad no reconocida'])
            ->assertStatus(400);
    }
}
