<?php

namespace App\Tests\Application;

use Symfony\Component\Panther\PantherTestCase;

class TestPantherTest extends PantherTestCase
{
    public function testCreate(): void
    {
        $client = static::createPantherClient(['browser' => static::FIREFOX]);
        $client->request('GET', '/test/');
        $client->followRedirects();

        $this->assertPageTitleSame('Test index');

        /*
         * $client->waitFor('#test span');
         * $this->assertSelectorTextContains('#test span', 'Coucou');
        */
        //$client->waitForElementToContain('#test span', 'Coucou');
        //$this->assertSelectorWillExist('#test span');
        $this->assertSelectorWillContain('#test span', 'Coucou');


        $client->clickLink('Create new');

        $this->assertPageTitleSame('New Test');
        $this->assertSelectorTextSame('h1', 'Create new Test');

        $client->submitForm('Save', [
            'test[name]' => 'Coucou end to end',
        ]);

        $this->assertSelectorTextContains('table', 'Coucou end to end');
    }
}
