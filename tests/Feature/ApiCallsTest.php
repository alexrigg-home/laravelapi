<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiCallsTest extends TestCase
{
    //refreshes db then uses transactions to clear data between tests
    use RefreshDatabase;
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
    public function testAllArticles()
    {
        $testpass = encryptpassword('password123');
        $user = factory('App\User')->create([
                'name' => 'testbob',
                'email' => 'bob@testing.com', 
                'password' => $testpass,
                'api_token' => 'exampleapitoken'
        ]);

        $article = factory('App\Article')->create([
                'title' => 'my first example article title',
                'body' => 'My first example article description for testing purposes'
        ]);

        $article = factory('App\Article')->create([
                'title' => 'my second example article title',
                'body' => 'My second example article description for testing purposes'
        ]);

        $article = factory('App\Article')->create([
                'title' => 'my third example article title',
                'body' => 'My third example article description for testing purposes'
        ]);
                        
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization'=> 'Bearer exampleapitoken'
        ])->json(
            'GET', 
            '/api/articles'
         );
         
         $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'my first example article title'
            ]); 
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'my second example article title'
            ]); 
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'body' => 'My third example article description for testing purposes'
            ]); 
    }

    /**
     *  test get articles
     *
     * @return void
     */
    public function testSingleArticle()
    {

        $testpass = encryptpassword('password123');
        $user = factory('App\User')->create([
                'name' => 'testbob',
                'email' => 'bob@testing.com', 
                'password' => $testpass,
                'api_token' => 'exampleapitoken'
        ]);

        $article = factory('App\Article')->create([
                'title' => 'my example article title',
                'body' => 'My example article desciption for testing purposes'
        ]);
                        
        //annoyingly the refresh db doesnt refresh autoincrement!
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization'=> 'Bearer exampleapitoken'
        ])->json(
            'GET', 
            '/api/articles/4'
         );
             

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'my example article title',
                'body' =>  'My example article desciption for testing purposes'
            ]); 
    }


}
