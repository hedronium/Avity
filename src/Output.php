<?php
// Output.php
namespace Hedronium\Avity;

use Imagine\Image\ImageInterface;

/**
* Handles outputing operations to varios
* output streams.
*/
class Output
{
  	protected $canvas = null;

  	protected $type = 'jpg';
    protected $quality = 85;

    /**
     * @param $canvas ImageInterface The Imagine Image
     */
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

  	/**
  	 * Sets the quality of the output image.
  	 *
  	 * @param $quality integer the quality of the image in percentage.
  	 */
  	public function quality($quality = 100)
    {
      	// Checks if the $quality is in between 0 and 100
      	if ($quality > 100 || $quality < 0) {
          	throw new \Exception('Quality value must be between 0 and 100');
      	}

      	$this->quality = $quality;
      	return $this;
    }

    protected function qualityOption($type = false)
    {
        if (!$type) {
            $type = $this->type;
        }

        if ($type === 'png') {
            // PNG Compression Value from 0 to 9
            return ['png_compression_level' => round(($this->quality*9)/100)];
        } elseif ($type === 'jpg') {
            return ['jpeg_quality' => $this->quality];
        }

        return [];
    }

  	/**
  	 * Outputs image to browser.
  	 */
  	public function toBrowser()
    {
        $this->canvas->show($this->type,  $this->qualityOption());
    }

  	/**
  	 * Outputs image to file.
  	 *
  	 * @param $name Filename to output to.
  	 */
  	public function toFile($name)
    {
        $type = strtolower(substr(strrchr($name, '.'), 1));
        $this->canvas->show($name, $this->qualityOption($type));
    }
}
