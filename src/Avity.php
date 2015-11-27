<?php
namespace Hedronium\Avity;

use Imagine\Image\ImagineInterface;

class Avity
{
    const HASHED_GENERATOR = 1;
  	const RANDOM_GENERATOR = 2;

  	const VERTICAL_MIRROR_LAYOUT = 1;
    const HORIZONTAL_MIRROR_LAYOUT = 2;
  	const DIAGONAL_MIRROR_LAYOUT = 3;

  	const SQUARE_STYLE = 1;
    const CIRCLE_STYLE = 2;
  	const SQUARE_CIRCLE_STYLE = 3;

  	protected $generator = null;
    protected $layout    = null;
    protected $style 	 = null;
  	protected $drawer 	 = null;

  	/**
    * Factory for Avity.
    *
    * @param $generator string|integer The Generator to be Used
    * @param $layout string|integer The Layout to be Used
    * @param $style string|integer The Style to be Used
    */
  	public static function init($generator = self::HASHED_GENERATOR, $layout = self::VERTICAL_MIRROR_LAYOUT, $style = self::SQUARE_STYLE)
    {
        $generator_obj = null;
      	$layout_obj = null;
      	$style_obj = null;
        $drawer_obj = null;

      	switch ($generator) {
            case static::RANDOM_GENERATOR:
                $generator_obj = new Generators\Random;
                break;

            case static::HASHED_GENERATOR:
      		default:
      			$generator_obj = new Generators\Hash;
        }

      	switch ($layout) {
            case static::DIAGONAL_MIRROR_LAYOUT:
                $layout_obj = new Layouts\DiagonalMirror($generator_obj);
                break;

      		case static::HORIZONTAL_MIRROR_LAYOUT:
                $layout_obj = new Layouts\HorizontalMirror($generator_obj);
                break;

  			case static::VERTICAL_MIRROR_LAYOUT:
      		default:
      			$layout_obj = new Layouts\VerticalMirror($generator_obj);
        }

        if (class_exists("Imagick")) {
            // If Imagick is installed
            $drawer_obj = new \Imagine\Imagick\Imagine();
        } elseif (function_exists('imagecolorallocate')) {
            // If Gd is Installed
            $drawer_obj = new \Imagine\Gd\Imagine();
        } else {
            throw new \Exception('Neither ImageMagik nor PHP GD is installed.');
        }


      	switch ($style) {
            case static::SQUARE_CIRCLE_STYLE:
                $style_obj = new Styles\SquareCircle($layout_obj, $generator_obj, $drawer_obj);
                break;

            case static::CIRCLE_STYLE:
                $style_obj = new Styles\Circle($layout_obj, $generator_obj, $drawer_obj);
                break;

  			case static::SQUARE_STYLE:
            default:
      			$style_obj = new Styles\Square($layout_obj, $generator_obj, $drawer_obj);
        }

      	return new static($generator_obj, $layout_obj, $style_obj, $drawer_obj);
    }

    /**
     * @param $generator Generator the Generator object
     * @param $layout Layout The Layout object
     * @param $style Style The Style object
     * @param $drawer ImagineInterface The Image Drawing Library Object
     */
    public function __construct(Generator $generator, Layout $layout, Style $style, ImagineInterface $drawer)
    {
        $this->generator = $generator;
      	$this->layout = $layout;
      	$this->style = $style;
        $this->drawer = $drawer;
    }

    /**
     * Sets the number of columns in the generated identicon
     *
     * @param $columns integer Number of columns
     */
    public function columns($columns)
    {
        $this->layout->columns($columns);
        return $this;
    }

    /**
     * Sets the number of rows in the generated identicon
     *
     * @param $rows integer Number of rows
     */
    public function rows($rows)
    {
        $this->layout->rows($rows);
        return $this;
    }

    /**
     * Sets the height of the generated image.
     *
     * @param $height integer The height of the image
     */
    public function height($height)
    {
        $this->style->height($height);
        return $this;
    }

    /**
     * Sets the width of the generated image.
     *
     * @param $height integer The width of the image
     */
    public function width($width)
    {
        $this->style->width($width);
        return $this;
    }

    /**
     * Sets the padding of the generated image.
     *
     * @param $height integer The padding of the image
     */
    public function padding($padding)
    {
        $this->style->padding($padding);
        return $this;
    }

    /**
     * Seeds the Generator with Hash
     *
     * @param $string integer|string
     */
    public function hash($string)
    {
        if ($this->generator instanceof HashedInterface) {
            $this->generator->hash($string);
        } else {
            throw new \Exception('Generator does not support hash seeding.');
        }

        return $this;
    }

    /**
     * Returns the style object
     *
     * @return Style The style object.
     */
    public function style()
    {
        return $this->style;
    }

    /**
     * Returns the layout object
     *
     * @return Layout The Layout object.
     */
    public function layout()
    {
        return $this->layout;
    }

    /**
     * Returns the generator object
     *
     * @return Generator The Generator object.
     */
    public function generator()
    {
        return $this->generator;
    }

    /**
     * Returns the Image Drawing Library object
     *
     * @return ImagineInterface The drawing library object.
     */
    public function drawer()
    {
        return $this->drawer;
    }

    /**
     * Returns an Outputer instance that can be used to
     * output images to the browser or file.
     *
     * @return Output The Outputer object.
     */
    public function generate()
    {
      	return new Output($this->style->draw());
    }
}
