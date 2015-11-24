<?php
namespace Hedronium\Avity;

/**
 * Base class for generators.
 *
 * Generators dictade which blocks of a grid gets draw in
 * and what type of drawing a block gets (if aplicable)
 */

abstract class Generator
{
  	/**
	 * States if the particular
	 * location should have an object or not
	 *
	 * @param  integer $x x-coordinate of location
	 * @param  integer $y y-coordinate of location
	 * @return integer   States if the particular
	 *                   location should have an object or not and what type of object
	 */
    abstract public function next($x, $y);
}
