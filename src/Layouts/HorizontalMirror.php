<?php
// VerticalMirror.php
namespace Hedronium\Avity\Layouts;

use Hedronium\Avity\Layout;
use Hedronium\Avity\Generator;

class HorizontalMirror extends Layout
{

    /**
     * Flips the Sub-Grid which is used as an element of the
     * grid.
     *
     * @param $sub_grid array the Sub-Grid
     */
    protected function flipHorizontal(array $sub_grid)
    {
        $rows = count($sub_grid);
        $columns = count($sub_grid[0]);

        $max_rows = $columns/2;

        if ($columns&1 == 0) {
            $max_rows -= 1;
        }

        for ($y = 0; $y < $max_rows; $y++) {
            for ($x = 0; $x < $columns; $x++) {
                $tmp = $sub_grid[$y][$x];
                $sub_grid[$y][$x] = $sub_grid[$rows-1-$y][$x];
                $sub_grid[$rows-1-$y][$x] = $tmp;
            }
        }

        return $sub_grid;
    }


    public function drawGrid(array $values = array(false, true))
    {
        $gen = $this->generator;

        $grid = [];

        $max_rows = $this->columns/2;

        if ($this->rows&1 === 0) {
              $max_rows -= 1;
        }

      	$max_rows = ceil($max_rows);

        for ($y = 0; $y < $max_rows; $y++) {
            $grid[$y] = [];

            for ($x = 0; $x < $this->columns; $x++) {
                $value = $this->shouldDraw($values);
                $grid[$y][$x] = $value;
                $grid[($this->rows-1)-$y][$x] = is_array($value) ? $this->flipHorizontal($value) : $value;
            }

        }

        return $grid;
    }
}
