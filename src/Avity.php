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

    public function generate()
    {
      	// returns an
      	return new Output($this->style->draw());
    }
}
