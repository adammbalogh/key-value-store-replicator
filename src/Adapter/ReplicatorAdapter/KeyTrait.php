<?php namespace AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

trait KeyTrait
{
    /**
     * Removes a key.
     *
     * @param string $key
     *
     * @return bool True if the deletion was successful, false if the deletion was unsuccessful.
     *
     * @throws \Exception
     */
    public function delete($key)
    {
        if ($this->source->delete($key)) {
            return $this->replica->delete($key);
        }

        return false;
    }

    /**
     * Sets a key's time to live in seconds.
     *
     * @param string $key
     * @param int $seconds
     *
     * @return bool True if the timeout was set, false if the timeout could not be set.
     *
     * @throws \Exception
     */
    public function expire($key, $seconds)
    {
        if ($this->source->expire($key, $seconds)) {
            return $this->replica->expire($key, $seconds);
        }

        return false;
    }

    /**
     * Returns the remaining time to live of a key that has a timeout.
     *
     * @param string $key
     *
     * @return int Ttl in seconds.
     *
     * @throws \AdammBalogh\KeyValueStore\Exception\KeyNotFoundException
     * @throws \Exception
     */
    public function getTtl($key)
    {
        return $this->source->getTtl($key);
    }

    /**
     * Determines if a key exists.
     *
     * @param string $key
     *
     * @return bool True if the key does exist, false if the key does not exist.
     */
    public function has($key)
    {
        return $this->source->has($key);
    }

    /**
     * Removes the existing timeout on key, turning the key from volatile (a key with an expire set)
     * to persistent (a key that will never expire as no timeout is associated).
     *
     * @param string $key
     *
     * @return bool True if the persist was success, false if the persis was unsuccessful.
     *
     * @throws \Exception
     */
    public function persist($key)
    {
        if ($this->source->persist($key)) {
            return $this->replica->persist($key);
        }

        return false;
    }
}
