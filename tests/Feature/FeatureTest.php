<?php

namespace App\Tests\Feature;

use App\Entity\Test;

afterEach(function () {
    self::ensureKernelShutdown();
    $client = static::createClient();
    $entityManager = $client
        ->getContainer()
        ->get('doctrine')
        ->getManager();
    $testRepository = $entityManager->getRepository(Test::class);

    foreach ($testRepository->findAll() as $object) {
        $testRepository->remove($object, true);
    }
});

it('should be able to create a Test entity from views', function () {
    self::ensureKernelShutdown();
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
});
