<?php

namespace App\tests\Func;

use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class UserTest extends WebTestCase
{
    private $userPayload = '{
        "email": "%s",
        "password": "password",
        "firstName": "test",
        "lastName": "test",
        "phone": "string",
        "age": 20,
        }';
    private $login_credentials = '{
        "username": "admin@admin.com",
        "password": "admin",

    }';

    public function testGetUsers(): void
    {
        $client = self::createClient();
        $client->request(
            Request::METHOD_GET,
            '/api/users.json'
        );
        $response =  $client->getResponse();
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        // dd($response->getStatusCode());
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }
    /*
    public function testLoginUser(): void
    {
        $client = self::createClient();
        $client->request(
            Request::METHOD_POST,
            '/api/login_check.json',
            [],
            [],
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
           $this->login_credentials
        );
        
        $response =  $client->getResponse();
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        
        dd($response->getStatusCode());
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

*/
    public function testPostUserAnonymousLogged(): void
    {
        $client = self::createClient();
        $client->request(
            Request::METHOD_POST,
            '/api/users.json',
            [],
            [],
            [],
            $this->getPayload()
        );
        $response =  $client->getResponse();
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        //  dd($response->getStatusCode());
        self::assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }

    private function getPayload(): string
    {
        $faker = Factory::create();

        return sprintf($this->userPayload, $faker->email);
    }
    /*
    public function testLoginPass()
    {
        $client = self::createClient();
        $client->request(
            Request::METHOD_POST,
            '/api/login_check',[],[]
            $this->login_credentials
        );
        // Check the content body
        $data = json_decode($client->getResponse()->getContent(), true);
        
    }
    */
}
