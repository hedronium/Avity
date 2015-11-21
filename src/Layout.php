<?php
namespace Hedronium\Avity;
use Hedronium\Avity\Generator;

abstract class Layout
{
  	protected $generator = null;

    public function __construct(Generator $generator)
    {
      	$this->generator = $generator;
    }

    abstract public function drawGrid();
}
