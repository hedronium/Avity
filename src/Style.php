<?php
// Style.php
namespace Hedronium\Avity;

/**
 * Base class for Styles.
 *
 * Styles dictate the shape of each individual block in a grid.
 * They also are reponsible for drawin ghte actual elemnts onto a GD canvas.
 */

abstract class Style
{
    public $height  = 300;
	public $width   = 300;
    public $padding = 40;

  	protected $layout = null;
  	protected $generator = null;

  	public function __construct(Layout $layout, Generator $generator)
    {
      	$this->layout = $layout;
      	$this->generator = $generator;
    }

  	// Grid gets the grid array from the layout object

  	protected function getGrid()
    {
      return $this->layout->drawGrid();
    }

     /**
	 * Generates the image and return s a GD handle.
	 * @return resource The GD resource handle of the image.
	 */

     abstract public function draw();
}
