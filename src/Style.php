<?php
// Style.php
namespace Hedronium\Avity;

use Imagine\Image\ImagineInterface;

/**
 * Base class for Styles.
 *
 * Styles dictate the shape of each individual block in a grid.
 * They also are reponsible for drawin ghte actual elemnts onto a GD canvas.
 */

abstract class Style
{
    protected $height  = 300;
	protected $width   = 300;
    protected $padding = 40;

  	protected $layout = null;
    protected $generator = null;
  	protected $drawer = null;

    /**
     * Sets the width of the image
     *
     * @param $width the width of the image.
     */
    public function width($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Sets the height of the image.
     *
     * @param $height The height of the image.
     */
    public function height($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Sets the padding of the image
     *
     * @param $padding the padding of the image.
     */
    public function padding($padding)
    {
        $this->padding = $padding;
        return $this;
    }

  	public function __construct(Layout $layout, Generator $generator, ImagineInterface $drawer)
    {
      	$this->layout = $layout;
        $this->generator = $generator;
      	$this->drawer = $drawer;
    }

    /**
     * Gets the grid array from Layout
     *
     * @return array the grid array
     */
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
