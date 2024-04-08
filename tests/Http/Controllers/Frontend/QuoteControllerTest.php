<?php

namespace Tests\Http\Controllers\Frontend;

use App\Models\Frontend\Quote;
use Illuminate\Http\Request;
use Mockery;
use PHPUnit\Framework\TestCase;

class QuoteControllerTest extends TestCase
{
    /*
     * QuoteControllerTest tests QuoteController class
     */

    public function testGetApiDataMethod()
    {
        // Create a request object to emit to getApiData
        $request = new Request();

        // Mock a Quote model
        $quote = Mockery::mock(Quote::class);
        $quote->shouldReceive('getAttribute')->withAnyArgs()->andReturnSelf();
        $quote->name = "test name";
        $quote->email = "test@test.com";
        $quote->cityOfCar->name = "Test city";
        $quote->agentOfCar->email = "agent@test.com";
        $quote->modelOfCar->name = "BMW";
        $quote->gradeOfCar->name = "Test Grade";
        $quote->gradeOfCar->commercial_date = "2022-01-01";

        // Test getApiData
        $controller = new \App\Http\Controllers\Frontend\QuoteController();
        $apiData = $controller->getApiData($quote);

        // Assert that correct apiData is returned
        $this->assertIsArray($apiData);
        $this->assertArrayHasKey('prospect', $apiData);
        $this->assertArrayHasKey('requestdate', $apiData['prospect']);
        $this->assertArrayHasKey('customer', $apiData['prospect']);
        $this->assertArrayHasKey('vehicles', $apiData['prospect']);
        $this->assertArrayHasKey('provider', $apiData['prospect']);
        $this->assertArrayHasKey('vendor', $apiData['prospect']);
    }
}
