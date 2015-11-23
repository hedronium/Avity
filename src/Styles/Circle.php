<?php
namespace Hedronium\Avity\Styles;

use Hedronium\Avity\Style;

/**
*  Circle Object Style
*/
class Circle extends Style
{
    protected $spacing = 0;

    /**
     * Sets the spacing between blocks
     *
     * @param $spacing integer the spacing between blocks
     */
    public function spacing($spacing)
    {
        $this->spacing = $spacing;
        return $this;
    }

    public function draw()
    {
        $grid = $this->getGrid();

        $canvas = imagecreatetruecolor($this->width, $this->height);

        if (function_exists('imageantialias')) {
            imageantialias($canvas, true);
        }

        // olor for background
        $bg_color = imagecolorallocate($canvas, 240, 240, 240);

        // Fills the empty image with background color ( for now this is light grey )
        imagefill($canvas, 0, 0, $bg_color);

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
        $color = imagecolorallocate($canvas, 70, 70, 70);

        for ($y = 0; $y < $rows; $y++) {
              for ($x = 0; $x < $columns; $x++) {

                  // If the location in the grid array is true, we will draw a square in that position.
                  if ($grid[$y][$x] === true) {
                        imagefilledellipse(
                            $canvas,
                            ($block_width*$x)+$start_x+$center_x,
                            ($block_width*$y)+$start_y+$center_y,
                            $block_width-$spacing,
                            $block_height-$spacing,
                            $color
                        );
                  }

              }
        }

        return $canvas;
    }
}
