<?php
// Output.php
namespace Hedronium\Avity;

use Imagine\Image\ImageInterface;

/**
* This class handles output to various locations
*/
class Output
{
  	protected $canvas = null;
  	protected $type = IMG_JPEG;
    protected $quality = 100;

	public function __construct(ImageInterface $canvas)
    {
      	$this->canvas = $canvas;
    }

  	public function jpg()
    {
      	$this->type = 'jpg';
      	return $this;
    }

  	public function png()
    {
    	$this->type = 'png';
      	return $this;
    }

  	public function gif()
    {
      	$this->type = 'gif';
      	return $this;
    }

  	// Sets the quality of the of the output image
  	public function quality($quality = 100)
    {
      	// Checks if the $quality is in between 0 and 100
      	if ($quality > 100 || $quality < 0) {
          	throw new \Exception('Quality value must be between 0 and 100');
      	}

      	$this->quality = $quality;
      	return $this;
    }

  	// Outputs image to the browser
  	public function toBrowser()
    {
        $this->canvas->show($this->type);
    }

  	// Writes image to a specific file
  	public function toFile($name)
    {
        $this->canvas->show($name, $this->type);
    }
}
