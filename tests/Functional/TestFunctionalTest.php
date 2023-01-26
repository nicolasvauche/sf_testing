<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestFunctionalTest extends WebTestCase
{
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request('GET', '/test/');
        $client->followRedirects();

        $this->assertPageTitleSame('Test index');
        $client->clickLink('Create new');

        $this->assertPageTitleSame('New Test');
        $this->assertSelectorTextSame('h1', 'Create new Test');

        $client->submitForm('Save', [
            'test[name]' => 'Coucou end to end',
        ]);

        $this->assertSelectorTextContains('table', 'Coucou end to end');
    }
}
