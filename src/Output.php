<?php
// Output.php
namespace Hedronium\Avity;

class Output
{
  	protected $canvas = null;
  	protected $type = IMG_JPEG;
    protected $quality = 100;

	public function __construct($canvas)
    {
      	if (get_resource_type($canvas) !== 'gd') {
            throw new \Exception('Not a GD Resource.');
      	}

      	$this->canvas = $canvas;
    }

  	public function jpg()
    {
      	$this->type = IMG_JPEG;
      	return $this;
    }

  	public function png()
    {
    	$this->type = IMG_PNG;
      	return $this;
    }

  	public function gif()
    {
      	$this->type = IMG_GIF;
      	return $this;
    }

  	public function quality($quality = 100)
    {
      	if ($quality > 100 || $quality < 0) {
          	throw new \Exception('Quality value must be between 0 and 100');
      	}

      	$this->quality = $quality;
      	return $this;
    }

  	public function toBrowser()
    {
        switch ($this->type) {
        	case IMG_JPEG:
                header('Content-Type: image/jpeg');
          		imagejpeg($this->canvas, null, $this->quality);
          		break;

          	case IMG_PNG:
                header('Content-Type: image/png');
          		$quality = round(($this->quality/100)*9);
          		imagepng($this->canvas, null, $quality);
          		break;

          	case IMG_GIF:
                header('Content-Type: image/gif');
          		imagegif($this->canvas, null);
          		break;
        }
    }

  	public function toFile($name)
    {
		switch ($this->type) {
        	case IMG_JPEG:
          		imagejpeg($this->canvas, $name, $this->quality);
          		break;

          	case IMG_PNG:
          		$quality = round(($this->quality/100)*9);
          		imagepng($this->canvas, $name, $quality);
          		break;

          	case IMG_GIF:
          		imagegif($this->canvas, $name);
          		break;
        }
    }
}