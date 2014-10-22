<?php namespace AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

use AdammBalogh\KeyValueStore\AbstractKvsReplicatorTestCase;
use AdammBalogh\KeyValueStore\Adapter\MemoryAdapter;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;
use AdammBalogh\KeyValueStore\KeyValueStore;

class ServerTraitTest extends AbstractKvsReplicatorTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testFlush(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $kvs->set('key', 'value');

        $this->assertTrue($kvs->has('key'));

        $kvs->flush();

        $this->assertFalse($kvs->has('key'));
    }

    /**
     * @expectedException \Exception
     */
    public function testFlushError()
    {
        $memAdapterStub = \Mockery::mock('\AdammBalogh\KeyValueStore\Adapter\MemoryAdapter');
        $memAdapterStub->shouldReceive('flush')->andThrow('\Exception');

        $repAdapter = new ReplicatorAdapter($memAdapterStub, new MemoryAdapter());

        $kvs = new KeyValueStore($repAdapter);

        $kvs->flush('key', 'value');
    }
}
