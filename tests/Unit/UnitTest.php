<?php

namespace App\Tests\Unit;

use App\Entity\Test;

test('Entity Test can be created', function () {
    $test = new Test();

    $this->assertNull($test->getId());

    $test->setName('Youpi');
    $this->assertEquals('Youpi', $test->getName());
});

