<?php

namespace DMarynicz\Tests;

use Iterator;
use PHPUnit\Framework\MockObject\MockObject;

trait MockIterator
{
    /**
     * @param MockObject|Iterator<mixed> $iterator
     * @param array<mixed>               $items
     * @param bool                       $includeCallsToKey
     */
    public function mockIteratorItems(Iterator $iterator, array $items, $includeCallsToKey = false)
    {

        $arrayIterator = new \ArrayIterator($items);

        $iterator
            ->method('current')
            ->willReturnCallback(function () use ($arrayIterator) {
                return $arrayIterator->current();
            });
        $iterator
            ->method('key')
            ->willReturnCallback(function () use ($arrayIterator) {
                return $arrayIterator->key();
            });

        $iterator
            ->method('next')
            ->willReturnCallback(function () use ($arrayIterator): void {
                $arrayIterator->next();
            });

        $iterator
            ->method('rewind')
            ->willReturnCallback(function () use ($arrayIterator): void {
                $arrayIterator->rewind();
            });

        $iterator
            ->method('valid')
            ->willReturnCallback(function () use ($arrayIterator): bool {
                return $arrayIterator->valid();
            });
    }
}
