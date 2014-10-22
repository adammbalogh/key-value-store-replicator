<?php namespace AdammBalogh\KeyValueStore\Adapter\ReplicatorAdapter;

trait ValueTrait
{
    /**
     * Gets the value of a key.
     *
     * @param string $key
     *
     * @return mixed The value of the key.
     *
     * @throws \AdammBalogh\KeyValueStore\Exception\KeyNotFoundException
     */
    public function get($key)
    {
        return $this->source->get($key);
    }

    /**
     * Sets the value of a key.
     *
     * @param string $key
     * @param mixed $value Can be any of serializable data type.
     *
     * @return bool True if the set was successful, false if it was unsuccessful.
     *
     * @throws \Exception
     */
    public function set($key, $value)
    {
        if ($this->source->set($key, $value)) {
            return $this->replica->set($key, $value);
        }

        return false;
    }
}
