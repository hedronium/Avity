<?php
// Styles/Square.php
namespace Hedronium\Avity\Styles;
use Hedronium\Avity\Style;

class Square extends Style
{
    public function draw(array $grid)
    {
          $canvas = imagecreatetruecolor($this->width, $this->height);
          $bg_color = imagecolorallocate($canvas, 240, 240, 240);
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

          $color = imagecolorallocate($canvas, 70, 70, 70);

          for ($y = 0; $y < $rows; $y++) {
            	for ($x = 0; $x < $columns; $x++) {
                  	 imagefilledrectangle(
                         $canvas,
                         ($block_width*$x)+$start_x,
                         ($block_height*$y)+$start_y,
                         ($block_width*($x+1))+$start_x,
                         ($block_height*($y+1))+$start_y,
                         $color
                     );
            	}
          }

          return $canvas;
    }
}
