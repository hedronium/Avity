<?php
namespace Hedronium\Avity;

/**
 * Base class for generators.
 *
 * Generators produce integers that are used by both Layouts and Styles
 * in their operation
 */
abstract class Generator
{
  	/**
	 * Returns an Integer for a particular location.
	 *
	 * @param  integer $x x-coordinate of location
	 * @param  integer $y y-coordinate of location
	 * @return integer
	 */
    abstract public function next($x, $y);
}
