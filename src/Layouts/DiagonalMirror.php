<?php
namespace Hedronium\Avity\Layouts;

use Hedronium\Avity\Layout;

class DiagonalMirror extends Layout
{
    public function drawGrid()
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
                $value = $this->shouldDraw();

                $grid[$y][$x] = $value;
                $grid[$this->rows-$y-1][$this->columns-$x-1] = $value;
            }

            $columns--;
        }

        return $grid;
    }
}
