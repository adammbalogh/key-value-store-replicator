<?php namespace AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

trait ServerTrait
{
    /**
     * Removes all keys.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function flush()
    {
        try {
            $this->source->flush();
        } catch (\Exception $e) {
            throw $e;
        }

        $this->replica->flush();
    }
}
