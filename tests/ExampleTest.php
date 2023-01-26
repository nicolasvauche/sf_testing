<?php

test('example', function () {
    expect(true)->toBeTrue();
});

it('throws exception', function () {
    throw new Exception('Something happened.');
})->throws(Exception::class, 'Something happened.');
