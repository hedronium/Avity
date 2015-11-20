<?php
namespace Hedronium\Avity\Generators;

use Hedronium\Avity\Generator;

class Hash extends Generator
{
  protected $hash = "";
	protected $random = null;

    public function __construct()
    {
		$this->random = new \Savvot\Random\XorShiftRand;
    }

    public function hash($str)
    {
       	$this->random->setSeed($str);

    }

    public function shouldDraw($x, $y)
    {
    	return $this->random->randomBool();
    }
}
