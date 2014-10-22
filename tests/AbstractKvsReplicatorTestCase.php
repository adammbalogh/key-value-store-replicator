<?php namespace AdammBalogh\KeyValueStore;

use AdammBalogh\KeyValueStore\Adapter\MemoryAdapter;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

abstract class AbstractKvsReplicatorTestCase extends \PHPUnit_Framework_TestCase
{
    public function kvsProvider()
    {
        $srcMemAdapter = new MemoryAdapter();
        $repMemAdapter = new MemoryAdapter();

        $repAdapter = new ReplicatorAdapter($srcMemAdapter, $repMemAdapter);

        return [
            [
                new KeyValueStore($repAdapter),
                $repAdapter,
                $srcMemAdapter,
                $repMemAdapter
            ]
        ];
    }
}
