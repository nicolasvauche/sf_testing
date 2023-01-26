<?php

namespace App\Tests\Unit;

use App\Entity\Test;
use PHPUnit\Framework\TestCase;

class TestUnitTest extends TestCase
{
    public function testEntity(): void
    {
        $test = new Test();

        $this->assertNull($test->getId());

        $test->setName('Youpi');
        $this->assertEquals('Youpi', $test->getName());
    }

    public function testFormType(): void
    {
        $this->markTestSkipped('Built-in FormTypes are not unit tested, they are tested through Controllers functional tests.');
    }

    public function testController(): void
    {
        $this->markTestSkipped('Controllers are functionally tested');
    }
}
