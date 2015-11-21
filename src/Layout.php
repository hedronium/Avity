<?php
namespace Hedronium\Avity;
use Hedronium\Avity\Generator;

/**
 * Base Class for Layouts
 *
 * Layouts dictate how the generated elements
 * will be arraged in the grid as a complete array from a blank array.
 */
abstract class Layout
{

  	protected $generator = null;

    public function __construct(Generator $generator)
    {
      	$this->generator = $generator;
    }

  	// This is abstract method generates the array representing grid ( it is using values from Generator object)
    abstract public function drawGrid();
}
