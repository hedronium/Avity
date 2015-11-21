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
  	protected $style 		 = null;

  	public static function init($generator = self::HASHED_GENERATOR, $layout = self::VERTICAL_MIRROR_LAYOUT, $style = self::SQUARE_STYLE)
    {
      	$generator_obj = null;
      	$layout_obj = null;
      	$style_obj = null;

      	switch ($generator) {
      			case static::HASHED_GENERATOR:
          	default:
          			$generator_obj = new Generators\Hash;
        }

      	switch ($layout) {
      			case static::VERTICAL_MIRROR_LAYOUT:
          	default:
          			$layout_obj = new Layouts\VerticalMirror($generator_obj);
        }

      	switch ($style) {
      			case static::SQUARE_STYLE:
          	default:
          			$style_obj = new Styles\Square($layout_obj, $generator_obj);
        }

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
      	return new Output($this->style->draw());
    }
}
