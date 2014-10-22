<?php namespace AdammBalogh\KeyValueStore\Adapter;

class ReplicatorAdapterTest extends \PHPUnit_Framework_TestCase
{
    public function testInstantiation()
    {
        $srcMemAdapter = new MemoryAdapter();
        $repMemAdapter = new MemoryAdapter();

        $repAdapter = new ReplicatorAdapter($srcMemAdapter, $repMemAdapter);

        $this->assertEquals($srcMemAdapter, $repAdapter->getAdapter());
    }
}
