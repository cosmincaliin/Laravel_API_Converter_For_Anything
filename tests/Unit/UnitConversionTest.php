use Tests\TestCase;

<?php

namespace Tests\Unit;


class UnitConversionTest extends TestCase
{
    public function testLengthConversion()
    {
        $this->assertConversion('/convert/length/10/meters', 32.8084);
        $this->assertConversion('/convert/length/20/feet', 6.096);
    }

    public function testWeightConversion()
    {
        $this->assertConversion('/convert/weight/10/kilograms', 22.0462);
        $this->assertConversion('/convert/weight/20/pounds', 9.07184);
    }

    public function testTemperatureConversion()
    {
        $this->assertConversion('/convert/temperature/0/celsius', 32);
        $this->assertConversion('/convert/temperature/32/fahrenheit', 0);
    }

    public function testVolumeConversion()
    {
        $this->assertConversion('/convert/volume/10/liters', 2.64172);
        $this->assertConversion('/convert/volume/5/gallons', 18.9271);
    }

    public function testSpeedConversion()
    {
        $this->assertConversion('/convert/speed/100/kilometers', 62.1371);
        $this->assertConversion('/convert/speed/50/miles', 80.4672);
    }

    private function assertConversion($url, $expectedResult)
    {
        $response = $this->get($url);
        $response->assertStatus(200)
            ->assertJson(['result' => $expectedResult]);
    }
}
