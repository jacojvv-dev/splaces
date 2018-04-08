<?php

namespace Tests\Feature;

use App\DAL\SearchRepository;
use App\DAL\WeatherRepository;
use App\Photo;
use App\Recommendation;
use App\Search;
use App\User;
use App\UserVenue;
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
        Recommendation::whereLocation('-29.8579000,31.0292000')->delete();
        Weather::whereLocation('Durban')->delete();
        Weather::whereLocation('-29.8579000,31.0292000')->delete();
        Photo::whereLocation('Durban')->delete();
        Search::whereLocation('Durban')->delete();
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

    public function testGetRecommendationsForCoordinate()
    {
        // initial
        $response = $this->get('data/recommendations/-29.8579000,31.0292000/null/null');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

        // cached
        $response = $this->get('data/recommendations/-29.8579000,31.0292000/null/null');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

    }

    public function testGetRecommendationsCreatesPlaceholderForWeirdQueries()
    {
        $response = $this->get('data/recommendations/Durban/null/Dentist');
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

    public function testGetWeatherForCoordinate()
    {
        // assert initial
        $response = $this->get('data/weather/-29.8579000,31.0292000');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

        //assert cached
        $response = $this->get('data/weather/-29.8579000,31.0292000');
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

    public function testGetUserEmptyWithoutUser()
    {
        $response = $this->get('data/user');
        $response->assertStatus(200);
        $this->assertEquals("", $response->getContent());
    }

    public function testGetVenueById()
    {
        $response = $this->get('/data/venue/4b93823cf964a5206b4634e3');
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testGetVenueFailsWithBonkersId()
    {
        $response = $this->get('/data/venue/4b93823cf964a5206b4634e3_look_at_my_horse');
        $response->assertStatus(404);
    }

    public function testAddUserVenue()
    {
        $data = [
            'id' => '4b93823cf964a5206b4634e3',
            'name' => 'Durban Botanic Gardens'
        ];

        $response = $this->actingAs($this->user)->call('POST', 'data/user/venues/add', $data);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function testRemoveUserVenue()
    {
        $data = [
            'id' => '4b93823cf964a5206b4634e3',
            'name' => 'Durban Botanic Gardens'
        ];

        $response = $this->actingAs($this->user)->call('POST', 'data/user/venues/add', $data);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

        $data = [
            'id' => '4b93823cf964a5206b4634e3'
        ];
        $response = $this->actingAs($this->user)->call('POST', 'data/user/venues/remove', $data);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());

    }

    protected function tearDown()
    {
        UserVenue::whereUserId($this->user->id)->delete();
        User::whereId($this->user->id)->delete();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

}
