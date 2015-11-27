<?php
// Styles/Square.php
namespace Hedronium\Avity\Styles;

use Imagine\Image\Point;
use Imagine\Image\Box;
use Imagine\Image\Palette\RGB;

/**
*  This class draws the actual image with squares using grid data
*/
class Triangle extends Square
{
    protected $types = [
        false, false, false, false, false,
        [
            [0,1],
            [1,1]
        ],
        [
            [1,0],
            [1,1]
        ],
        [
            [1,1],
            [1,0]
        ],
        [
            [1,1],
            [0,1]
        ],
        [
            [1,1],
            [1,1]
        ]
    ];

    protected function getGrid()
    {
        return $this->layout->drawGrid($this->types);
    }

    public function draw()
    {
        // Gets the grid data array
        // eta grid value nicche Layout object theke
        $grid = $this->getGrid();

        $palette = new RGB;

        $canvas = $this->drawer->create(
            new Box($this->width, $this->height),
            $palette->color($this->background)
        );

        // Calculations
        $start_x = $this->padding;
        $start_y = $this->padding;

        // counts the number of roews
        $rows = count($grid);

        // counts the number of columns in each row
        $columns = count($grid[0]);

        // Calculates the area useable (leaving out space for padding)
        $working_width = $this->width - ($this->padding*2);
        $working_height = $this->height - ($this->padding*2);

        // Calculates the size of each grid block within the usable area
        $block_width = $working_width/$columns;
        $block_height = $working_height/$rows;

        // Calculate Spacing
        $spacing = $this->spacing/2;

        // Creates a color to be used to draw the squares
        $color = $canvas->palette()->color($this->foregroundColor());

        // Loops thorugh the rows
        for ($y = 0; $y < $rows; $y++) {
        	for ($x = 0; $x < $columns; $x++) {

        		// If the location in the grid array is true, we will draw a square in that position.
              	if ($grid[$y][$x] !== false) {
                   // Draws the square
                   $points = [];

                   $block = $grid[$y][$x];

                   if ($block[0][0] === 1) {
                       $points[] = new Point(($block_width*$x)+$start_x+$spacing, ($block_height*$y)+$start_y+$spacing);
                   }

                   if ($block[0][1] === 1) {
                       $points[] = new Point(($block_width*($x+1))+$start_x-$spacing, ($block_height*$y)+$start_y+$spacing);
                   }

                   if ($block[1][1] === 1) {
                       $points[] = new Point(($block_width*($x+1))+$start_x-$spacing, ($block_height*($y+1))+$start_y-$spacing);
                   }

                   if ($block[1][0] === 1) {
                       $points[] = new Point(($block_width*$x)+$start_x+$spacing, ($block_height*($y+1))+$start_y-$spacing);
                   }

                   $canvas->draw()->polygon($points, $color, true);
                }

                $color = $this->varryColor($color, $canvas);
        	}
        }

        return $canvas;
    }
}
