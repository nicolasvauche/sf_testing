<?php

namespace App\Tests\Application;

use App\Entity\Test;
use Symfony\Component\Panther\PantherTestCase;

class TestPantherTest extends PantherTestCase
{
    private $client;

    public function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->client = static::createPantherClient(['browser' => static::FIREFOX]);
    }

    public function tearDown(): void
    {
        $entityManager = $this->getContainer()
            ->get('doctrine')
            ->getManager();
        $testRepository = $entityManager->getRepository(Test::class);

        foreach ($testRepository->findAll() as $object) {
            $testRepository->remove($object, true);
        }
    }

    public function testCreate(): void
    {
        $this->client->request('GET', '/test/');
        $this->client->followRedirects();

        $this->assertPageTitleSame('Test index');

        /*
         * $this->client->waitFor('#test span');
         * $this->assertSelectorTextContains('#test span', 'Coucou');
        */
        //$this->client->waitForElementToContain('#test span', 'Coucou');
        //$this->assertSelectorWillExist('#test span');
        $this->assertSelectorWillContain('#test span', 'Coucou');


        $this->client->clickLink('Create new');

        $this->assertPageTitleSame('New Test');
        $this->assertSelectorTextSame('h1', 'Create new Test');

        $this->client->submitForm('Save', [
            'test[name]' => 'Coucou Panther',
        ]);

        $this->assertSelectorTextContains('table', 'Coucou Panther');
    }
}
