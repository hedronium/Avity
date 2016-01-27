<?php
namespace Hedronium\Avity\Layouts;

use Hedronium\Avity\Layout;

class DiagonalMirror extends Layout
{

    /**
     * Flips the Sub-Grid which is used as an element of the
     * grid.
     *
     * @param $sub_grid array the Sub-Grid
     */
    protected function flipDiagonal(array $sub_grid)
    {
        $rows = count($sub_grid);
        $columns = count($sub_grid[0]);

        $columns_r = $columns;

        for ($y = 0; $y < $rows; $y++) {
            for ($x = 0; $x < $columns_r; $x++) {
                $tmp = $sub_grid[$y][$x];
                $sub_grid[$y][$x] = $sub_grid[$rows-1-$y][$columns-1-$x];
                $sub_grid[$rows-1-$y][$columns-1-$x] = $tmp;
            }

            $columns_r--;
        }

        return $sub_grid;
    }


    public function drawGrid(array $values = array(false, true))
    {
        $grid = [];

        for ($y = 0; $y < $this->rows; $y++) {
            $grid[$y] = [];
            for ($x = 0; $x < $this->columns; $x++) {
                $grid[$y][$x] = false;
            }
        }

        $columns = $this->columns;

        for ($y = 0; $y < $this->rows; $y++) {
            for ($x = 0; $x < $columns; $x++) {
                $value = $this->shouldDraw($values);

                $grid[$y][$x] = $value;
                $grid[$this->rows-$y-1][$this->columns-$x-1] = is_array($value) ? $this->flipDiagonal($value) : $value;
            }

            $columns--;
        }

        return $grid;
    }
}
