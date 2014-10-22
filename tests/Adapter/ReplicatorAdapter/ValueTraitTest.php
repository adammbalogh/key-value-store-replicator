<?php namespace AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

use AdammBalogh\KeyValueStore\AbstractKvsReplicatorTestCase;
use AdammBalogh\KeyValueStore\Adapter\MemoryAdapter;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;
use AdammBalogh\KeyValueStore\KeyValueStore;

class ValueTraitTest extends AbstractKvsReplicatorTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testGet(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $srcMem->set('key', 'value');

        $this->assertEquals('value', $kvs->get('key'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testSet(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $this->assertTrue($kvs->set('key', 5));

        $this->assertEquals(5, $kvs->get('key'));
        $this->assertEquals(5, $repMem->get('key'));
    }

    public function testSetError()
    {
        $memAdapterStub = \Mockery::mock('\AdammBalogh\KeyValueStore\Adapter\MemoryAdapter');
        $memAdapterStub->shouldReceive('set')->andReturn(false);

        $repAdapter = new ReplicatorAdapter($memAdapterStub, new MemoryAdapter());

        $kvs = new KeyValueStore($repAdapter);

        $this->assertFalse($kvs->set('key', 'value'));
    }
}
