<?php
// Styles/Square.php
namespace Hedronium\Avity\Styles;
use Hedronium\Avity\Style;
/**
*  This class draws the actual image using grid data
*/
class Square extends Style
{

    public function draw()
    {
          // Gets the grid data array
          // eta grid value nicche Layout object theke
          $grid = $this->getGrid();

          // create an empty black image
          $canvas = imagecreatetruecolor($this->width, $this->height);
          // Creates a color for background
          $bg_color = imagecolorallocate($canvas, 240, 240, 240);
          // Fills the empty image with background color ( for now this is light grey )
          imagefill($canvas, 0, 0, $bg_color);

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

          // Creates a color to be used to draw the squares
          $color = imagecolorallocate($canvas, 70, 70, 70);

          // Loops thorugh the rows
          for ($y = 0; $y < $rows; $y++) {

            	// loops through the columns
            	for ($x = 0; $x < $columns; $x++) {

					// If the location in the grid array is true, we will draw a square in that position.
                  	if ($grid[$y][$x] === true) {
                       // Draws the square
                       imagefilledrectangle(
                           $canvas,
                           // Caculates the co-ordinate (x, y) of the top-left corner of the square.
                           ($block_width*$x)+0,
                           ($block_height*$y)+0,

                         	// Caculates the co-ordinate (x, y) of the bottom-right corner of the square.
                           ($block_width*($x+1))+$start_x,
                           ($block_height*($y+1))+$start_y,

                           $color
                       );
                    }

            	}
          }

          return $canvas;
    }
}
