<?php

namespace App\tests\Func;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class GroupsTest extends WebTestCase
{
    private $serverInfo = [
        'ACCEPT' => 'application/json',
        'CONTENT_TYPE' => 'application/json'
    ];

    public function testGetGroups(): void
    {
        $client = self::createClient();
        $client->request(
            Request::METHOD_GET,
            '/api/groups.json'
        );
        $response =  $client->getResponse();
        $responseContent = $response->getContent();
        $responseDecoded = json_decode($responseContent);
        // dd($response->getStatusCode());
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecoded);
    }
}
