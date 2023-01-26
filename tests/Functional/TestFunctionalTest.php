<?php

namespace App\Tests\Functional;

use App\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestFunctionalTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function tearDown(): void
    {
        $entityManager = $this->client
            ->getContainer()
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
        $this->client->clickLink('Create new');

        $this->assertPageTitleSame('New Test');
        $this->assertSelectorTextSame('h1', 'Create new Test');

        $this->client->submitForm('Save', [
            'test[name]' => 'Coucou end to end',
        ]);

        $this->assertSelectorTextContains('table', 'Coucou end to end');
    }
}
