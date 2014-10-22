<?php namespace AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

use AdammBalogh\KeyValueStore\AbstractKvsReplicatorTestCase;
use AdammBalogh\KeyValueStore\Adapter\MemoryAdapter;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;
use AdammBalogh\KeyValueStore\KeyValueStore;

class KeyTraitTest extends AbstractKvsReplicatorTestCase
{
    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testDelete(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $kvs->set('key', 'value');

        $this->assertTrue($kvs->delete('key'));
    }

    public function testDeleteError()
    {
        $memAdapterStub = \Mockery::mock('\AdammBalogh\KeyValueStore\Adapter\MemoryAdapter');
        $memAdapterStub->shouldReceive('delete')->andReturn(false);

        $repAdapter = new ReplicatorAdapter($memAdapterStub, new MemoryAdapter());

        $kvs = new KeyValueStore($repAdapter);

        $this->assertFalse($kvs->delete('key', 'value'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testExpire(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $kvs->set('key', 'value');

        $this->assertTrue($kvs->expire('key', 5));
    }

    public function testExpireError()
    {
        $memAdapterStub = \Mockery::mock('\AdammBalogh\KeyValueStore\Adapter\MemoryAdapter');
        $memAdapterStub->shouldReceive('expire')->andReturn(false);

        $repAdapter = new ReplicatorAdapter($memAdapterStub, new MemoryAdapter());

        $kvs = new KeyValueStore($repAdapter);

        $this->assertFalse($kvs->expire('key', 5));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testGetTtl(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $kvs->set('key', 'value');
        $kvs->expire('key', 5);

        $this->assertEquals(5, $kvs->getTtl('key'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testHas(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $kvs->set('key', 'value');

        $this->assertTrue($kvs->has('key'));
    }

    /**
     * @dataProvider kvsProvider
     *
     * @param KeyValueStore $kvs
     * @param ReplicatorAdapter $rep
     * @param MemoryAdapter $srcMem
     * @param MemoryAdapter $repMem
     */
    public function testPersist(KeyValueStore $kvs, ReplicatorAdapter $rep, MemoryAdapter $srcMem, MemoryAdapter $repMem)
    {
        $kvs->set('key', 'value');
        $kvs->expire('key', 5);

        $this->assertTrue($kvs->persist('key'));
    }

    public function testPersistError()
    {
        $memAdapterStub = \Mockery::mock('\AdammBalogh\KeyValueStore\Adapter\MemoryAdapter');
        $memAdapterStub->shouldReceive('persist')->andReturn(false);

        $repAdapter = new ReplicatorAdapter($memAdapterStub, new MemoryAdapter());

        $kvs = new KeyValueStore($repAdapter);

        $this->assertFalse($kvs->persist('key'));
    }
}
