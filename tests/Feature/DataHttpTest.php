<?php

namespace Tests\Feature;

use App\DAL\WeatherRepository;
use App\Photo;
use App\Recommendation;
use App\User;
use App\Weather;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataHttpTest extends TestCase
{

    private $user;


    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        Recommendation::whereLocation('Durban')->delete();
        Weather::whereLocation('Durban')->delete();
        Photo::whereLocation('Durban')->delete();
    }

    public function testGetRecommendations()
    {
        // assert initial
        $response = $this->get('data/recommendations/Durban/null/null');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

        //assert cached
        $response = $this->get('data/recommendations/Durban/null/null');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetWeather()
    {
        // assert initial
        $response = $this->get('data/weather/Durban');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

        //assert cached
        $response = $this->get('data/weather/Durban');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetPhotos()
    {
        // assert initial
        $response = $this->get('data/photos/Durban');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

        // assert cached
        $response = $this->get('data/photos/Durban');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetLatestSearches()
    {
        $response = $this->get('data/latestsearches');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetLatestVenueViews()
    {
        $response = $this->get('data/latestvenueviews');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetUser()
    {
        $response = $this->actingAs($this->user)->get('data/user');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetUserFailsWithoutUser()
    {
        $response = $this->get('data/user');
        $response->assertStatus(500);
    }

}
