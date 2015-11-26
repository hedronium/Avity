<?php
// VerticalMirror.php
namespace Hedronium\Avity\Layouts;

use Hedronium\Avity\Layout;
use Hedronium\Avity\Generator;

class HorizontalMirror extends Layout
{
    public function drawGrid($values = [false, true])
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
                $grid[($this->rows-1)-$y][$x] = $value;
            }

        }

        return $grid;
    }
}
