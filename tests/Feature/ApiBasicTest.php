<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Generator as Faker;
use Tests\TestCase;

class ApiBasicTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRegister()
    {

        $response = $this->json(
            'POST', 
            '/api/register', 
            [
            'name' => 'bob', 
            'email' => 'bob@testing.com', 
            'password' =>'password123',
            'password_confirmation' =>'password123',
             ]
         );

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'bob',
                    'email' => 'bob@testing.com'
                ]
            ]);
    }

}
