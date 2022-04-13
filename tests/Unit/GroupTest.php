<?php

namespace App\tests\Unit;

use App\Entity\Group;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{

    private $group;
    protected function setUp(): void
    {
        parent::setUp();

        $this->group = new Group();
    }

    public function testGetName(): void
    {
        $value = 'test name groupe';
        $response = $this->group->setName($value);
        self::assertInstanceOf(Group::class, $response);
        self::assertEquals($value, $this->group->getName());
    }
    public function testGetdescription(): void
    {
        $value = 'test description groupe';
        $response = $this->group->setDescription($value);
        self::assertInstanceOf(Group::class, $response);
        self::assertEquals($value, $this->group->getDescription());
    }
}
