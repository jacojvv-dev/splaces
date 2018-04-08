<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicHttpTest extends TestCase
{
    public function testGetSiteIndex()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }


    public function testGetRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }


    public function testRegisterPost()
    {
        $data = [
            'name' => 'Fake',
            'email' => 'fake@fake22222.com',
            'password' => 'password'
        ];

        $response = $this->call('POST', '/register', $data);
        $response->assertStatus(302);
    }

    public function testGetLogin()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testGetForgotPassword()
    {
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
    }

}
