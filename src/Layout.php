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
    /**
     * @var integer the rows in the grid
     */
    protected $rows = 5;

    /**
     * @var integer the columns in the grid
     */
  	protected $columns = 5;

    /**
     * @var Generator stores the Generator Object
     */
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

    /**
     * Returns a random value that should be drawn at a grid location
     *
     * @param $values array the values to choose from
     * @param $x the x coordinate of the position.
     * @param $y the y coordinate of the position.
     *
     * @return mixed The value to the drawn
     */
    protected function shouldDraw(&$values = [false, true], $x = 0, $y = 0)
    {
        return $values[$this->generator->next($x, $y)%count($values)];
    }

  	/**
  	 * Draws the grid with values randomly selected from array
  	 *
  	 * @param $values array The list of values to choose from
  	 * @return array The grid representing the Image
  	 */
    abstract public function drawGrid(array $values = [false,true]);
}
