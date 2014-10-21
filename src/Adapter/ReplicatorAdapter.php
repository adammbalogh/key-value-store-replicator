<?php namespace AdammBalogh\KeyValueStore\Adapter;

use AdammBalogh\KeyValueStore\Contract\AdapterInterface;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter\KeyTrait;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter\ValueTrait;
use AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter\ServerTrait;

class ReplicatorAdapter implements AdapterInterface
{
    use KeyTrait, ValueTrait, ServerTrait;

    /**
     * @var AdapterInterface
     */
    protected $source;

    /**
     * @var AdapterInterface
     */
    protected $replica;

    /**
     * @param AdapterInterface $source
     * @param AdapterInterface $replica
     */
    public function __construct(AdapterInterface $source, AdapterInterface $replica)
    {
        $this->source = $source;
        $this->replica = $replica;
    }

    /**
     * Returns with the source's adapter
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->source->getAdapter();
    }
}
