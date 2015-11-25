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

    protected $background = [240, 240, 240];
    protected $foreground = null;

    public function foreground($r, $g, $b)
    {
        $this->foreground = [$r, $g, $b];
    }

    public function background($r, $g, $b)
    {
        $this->background = [$r, $g, $b];
    }

    protected function foregroundColor()
    {
        if (!$this->foreground) {
            $r = $this->generator->next(-1, -1)%256;
            $g = $this->generator->next(-1, -1)%256;
            $b = $this->generator->next(-1, -1)%256;

            $brightest = 255*3;
            $background_brightness = array_sum($this->background);
            $midpoint = $brightest/2;

            if ($background_brightness > $midpoint) {
                $ratio = ($background_brightness-($brightest*0.2))/$brightest;
            } else {
                $ratio = ($background_brightness+($brightest*0.4))/$brightest;
            }

            $r *= $ratio;
            $g *= $ratio;
            $b *= $ratio;

            return [$r, $g, $b];
        }

        return $this->foreground;
    }

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
