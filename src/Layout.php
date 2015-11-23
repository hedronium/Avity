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
    protected $rows = 5;
  	protected $columns = 5;

  	protected $generator = null;

    /**
     * Sets the number of rows in the identicon.
     *
     * @param $rows the number of rows.
     */
    public function rows($rows)
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * Sets the number of columns in the identicon
     *
     * @param $columns the number of columns
     */
    public function columns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function __construct(Generator $generator)
    {
      	$this->generator = $generator;
    }

    protected function shouldDraw($values = [false, true], $x = 0, $y = 0)
    {
        return $values[$this->generator->next($x, $y)%count($values)];
    }

  	// This is abstract method generates the array representing grid ( it is using values from Generator object)
    abstract public function drawGrid();
}
