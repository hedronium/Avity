<?php
namespace Hedronium\Avity\Styles;

use Hedronium\Avity\Style;

use Imagine\Image\Point;
use Imagine\Image\Box;
use Imagine\Image\Palette\RGB;

/**
*  Circle Object Style
*/
class Circle extends Square
{
    public function draw()
    {
        $grid = $this->getGrid();

        $palette = new RGB;

        $canvas = $this->drawer->create(
            new Box($this->width, $this->height),
            $palette->color($this->background)
        );

        // Calculations
        $start_x = $this->padding;
        $start_y = $this->padding;
        $rows = count($grid);
        $columns = count($grid[0]);
        $working_width = $this->width - ($this->padding*2);
        $working_height = $this->height - ($this->padding*2);
        $block_width = $working_width/$columns;
        $block_height = $working_height/$rows;
        $spacing = $this->spacing;

        $center_x = $block_width/2;
        $center_y = $block_height/2;

        // Color to be used to draw the squares
        $color = $canvas->palette()->color($this->foregroundColor());

        for ($y = 0; $y < $rows; $y++) {
              for ($x = 0; $x < $columns; $x++) {

                  // If the location in the grid array is true, we will draw a square in that position.
                  if ($grid[$y][$x] === true) {

                        $canvas->draw()->ellipse(
                            new Point(($block_width*$x)+$start_x+$center_x, ($block_width*$y)+$start_y+$center_y),
                            new Box($block_width-$spacing, $block_height-$spacing),
                            $color, true
                        );
                  }

                  $color = $this->varryColor($color, $canvas);

              }
        }

        return $canvas;
    }
}
