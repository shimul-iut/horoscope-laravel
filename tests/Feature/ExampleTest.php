<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_all_zodias_response()
    {
        $response = $this->get('/api/v1/zodiacs');

        $response->assertStatus(200);
    }

    public function test_get_a_given_day()
    {
        $response = $this->get('/api/v1/day/1');
        #this assertion will fail the first attempt when no zodiac calender score is populated
        $response->assertStatus(200);
    }

    public function test_create_calender_post_success_response(){
        $response = $this->postJson('api/v1/calender/create', ['zodiac_id' => '5', 'year' => '2021']);

        $response->assertStatus(200);
    }

    public function test_create_calender_post_invalid_data_response(){
        $response = $this->postJson('api/v1/calender/create', ['zodiac_id' => '5', 'year' => '20241']);

        $response->assertStatus(422);
    }
    public function test_create_zodiac_year_post_success_response(){
        $response = $this->postJson('api/v1/populate-all-zodiacs', ['year' => '2021']);

        $response->assertStatus(200);
    }

   

}
