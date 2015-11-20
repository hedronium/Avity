<?php
// VerticalMirror.php
namespace Hedronium\Avity\Layouts;

use Hedronium\Avity\Layout;
use Hedronium\Avity\Generator;


class VerticalMirror extends Layout
{
  	public $rows = 5;
  	public $columns = 5;

    public function drawGrid(Generator $gen)
    {
		$grid = [];

        $max_columns = $this->columns/2;

        if ($this->columns&1 === 0) {
              $max_columns -= 1;
        }

        for ($y = 0; $y < $this->rows; $y++) {
            // This will store the column value of the row
            $grid[$y] = [];

            for($x = 0; $x < $max_columns; $x++ ){
                  $value = $gen->shouldDraw($x,$y);

                  $grid[$y][$x] = $value;
                  $grid[$y][$this->columns-($x+1)] = $value;
            }
        }

        return $grid;
    }
}
