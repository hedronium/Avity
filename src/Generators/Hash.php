<?php
namespace Hedronium\Avity\Generators;

use Hedronium\Avity\Generator;
use Hedronium\Avity\HashedInterface;

/**
 *  This is Hashed Type generator . It returns the same patterns for a specific hash
 */

class Hash extends Generator implements HashedInterface
{
  	// This is a hash property which dictates the hash
  	protected $hash = "";

    // This property contains a randomizer object
	protected $random = null;


    public function __construct()
    {
        //This is a 3rd party Random library class
        $this->random = new \Savvot\Random\XorShiftRand;
    }

    public function hash($str)
    {
      	// This seeds the randomizer with a hash.
      	// TODO: The ability to seed the randomizer from main class

       	$this->random->setSeed($str);

    }

    public function shouldDraw($x, $y)
    {
      	// This returns a boolean from randomizer
      	return $this->random->randomBool();
    }
}
