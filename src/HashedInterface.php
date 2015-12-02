<?php
namespace Hedronium\Avity;

/**
 * Interface for Generators that are based on hashes
 */
interface HashedInterface
{
    /**
     * Sets a Value to hash and use as a seed for the random number generator
     *
     * @param $string string|integer hash seed value.
     */
    public function hash($string);
}
