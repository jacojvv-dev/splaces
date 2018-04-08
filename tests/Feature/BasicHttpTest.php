<?php

namespace Tests\Feature;

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
