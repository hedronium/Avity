<?php
namespace Hedronium\Avity\Generators;

use Hedronium\Avity\Generator;
use Hedronium\Avity\HashedInterface;

/**
 *  This is Hashed Type generator. It returns the same patterns for a specific hash
 */
class Hash extends Generator implements HashedInterface
{
    protected $state = 0;

    public function __construct()
    {
        $this->state = mt_rand();
    }

    public function hash($str)
    {
      	// This seeds the randomizer with a hash.
       	$this->state = crc32($str);
    }

    public function next($x, $y)
    {
        $this->state ^= $this->state >> 12;
	    $this->state ^= $this->state << 25;
    	$this->state ^= $this->state >> 27;

        return $this->state;
    }
}
