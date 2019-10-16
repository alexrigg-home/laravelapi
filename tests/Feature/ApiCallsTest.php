<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiCallsTest extends TestCase
{
    /**
     * login test
     *
     * @return void
     */
    public function testLogin()
    {
        $testpass = encryptpassword('password123');

        $user = factory('App\User')->create([
                'name' => 'testbob',
                'email' => 'bob@testing.com', 
                'password' => $testpass,
                'api_token' => 'exampleapitoken'
        ]);

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json(
            'POST', 
            '/api/login', 
            [           
            'email' => 'bob@testing.com', 
            'password' => 'password123',
             ]
         );

        //assertJson but this needs to be the whole of the json which is near impossible
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'testbob',
                'email' => 'bob@testing.com',                 
            ]);


        //$response->original["data"]["api_token"];

    }

    /**
     *  test get articles
     *
     * @return void
     */
    public function testArticles()
    {
        $testpass = encryptpassword('password123');
        $user = factory('App\User')->create([
                'name' => 'testbob2',
                'email' => 'bob2@testing.com', 
                'password' => $testpass,
                'api_token' => 'exampleapitoken'
        ]);

        $article = factory('App\Article')->create([
                'title' => 'my example article title',
                'body' => 'My example article desciption for testing purposes'
        ]);
                
        
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization'=> 'exampleapitoken'
        ])->json(
            'GET', 
            '/api/articles'
         );
         
         $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'my example article title',
                'body' => 'My example article desciption for testing purposes'               
            ]); 
    }
}
