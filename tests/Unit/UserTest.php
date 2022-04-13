<?php

namespace App\tests\Unit;

use App\Entity\Group;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testGetEmail(): void
    {

        $value = "aaaimad@gmail.com";
        $response = $this->user->setEmail($value);
        $getEmail = $this->user->getEmail();
        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $getEmail);
        self::assertEquals($value, $this->user->getUsername());
    }
    public function testGetRoles(): void
    {
        $value = ['ROLE_ADMIN'];
        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }
    public function testPassword(): void
    {
        $value = 'password';
        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPassword());
    }

    public function getArticle(): void
    {
        $value = new Group();
        //test for add Group
        $response = $this->user->addGroup($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getGroups());
        self::assertTrue($this->user->getGroups()->contains($value));

        //test for remove group from collection
        $response = $this->user->removeGroup($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(0, $this->user->getGroups());
        self::assertFalse($this->user->getGroups()->contains($value));
    }
}
