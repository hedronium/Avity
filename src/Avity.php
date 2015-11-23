<?php
namespace Hedronium\Avity;

class Avity
{
  	const HASHED_GENERATOR = 1;
  	const RANDOM_GENERATOR = 2;

  	const VERTICAL_MIRROR_LAYOUT = 1;
  	const HORIZONTAL_MIRROR_LAYOUT = 2;

  	const SQUARE_STYLE = 1;
  	const CIRCLE_STYLE = 2;

  	protected $generator = null;
    protected $layout    = null;
  	protected $style 	 = null;

  	/**
    * 	This static method initializes objects of the current class with appropriate dependencies.
    */
  	public static function init($generator = self::HASHED_GENERATOR, $layout = self::VERTICAL_MIRROR_LAYOUT, $style = self::SQUARE_STYLE)
    {
        $generator_obj = null;
      	$layout_obj = null;
      	$style_obj = null;

      	// checks the $generator parameter
      	switch ($generator) {
            // if the generator parameter is `1` or the constant
            case static::HASHED_GENERATOR:
      		// or by default
      		default:
      			$generator_obj = new Generators\Hash;
        }

      	// checks the $layout parameter
      	switch ($layout) {
      		// if the layout is Vertically Mirrored
  			case static::VERTICAL_MIRROR_LAYOUT:
      		// or by default
      		default:
      			$layout_obj = new Layouts\VerticalMirror($generator_obj);
        }

      	// checks the $style parameter
      	switch ($style) {
      		// if the layout is Vertically Mirrored
  			case static::SQUARE_STYLE:
      		// or by default
            default:
      			$style_obj = new Styles\Square($layout_obj, $generator_obj);
        }

      	// Creates an object of the current class with the dependencies and returns it
      	return new static($generator_obj, $layout_obj, $style_obj);
    }

    public function __construct(Generator $generator, Layout $layout, Style $style)
    {
        $this->generator = $generator;
      	$this->layout = $layout;
      	$this->style = $style;
    }

    /**
     * Sets the number of columns in the generated identicon
     *
     * @param $columns integer Number of columns
     */
    public function columns($columns)
    {
        $this->layout->columns = $columns;
        return $this;
    }

    /**
     * Sets the number of rows in the generated identicon
     *
     * @param $rows integer Number of rows
     */
    public function rows($rows)
    {
        $this->layout->rows = $rows;
        return $this;
    }

    /**
     * Sets the height of the generated image.
     *
     * @param $height integer The height of the image
     */
    public function height($height)
    {
        $this->style->height = $height;
        return $this;
    }

    /**
     * Sets the width of the generated image.
     *
     * @param $height integer The width of the image
     */
    public function width($width)
    {
        $this->style->width = $width;
        return $this;
    }

    /**
     * Sets the padding of the generated image.
     *
     * @param $height integer The padding of the image
     */
    public function padding($padding)
    {
        $this->style->padding = $padding;
        return $this;
    }

    /**
     * Seeds the Generator with Hash
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

    public function generate()
    {
      	// returns an
      	return new Output($this->style->draw());
    }
}
