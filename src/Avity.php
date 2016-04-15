<?php
namespace Hedronium\Avity;

use Imagine\Image\ImagineInterface;

class Avity
{
  	protected $generator = null;
    protected $layout    = null;
    protected $style 	 = null;
  	protected $drawer 	 = null;

    /**
     * Factory for Generator Classes
     *
     * @param $generator string The classname of the Generator
     */
    protected static function generator_construct($generator)
    {
        if(class_exists($generator)) {
            return new $generator();
        }

        throw new \Exception('The Generator class wasn\'t found.');
    }

    /**
     * Factory for Layout Classes
     *
     * @param $layout string The classname of the Layout
     * @param $generator Generator A generator Object
     */
    protected static function layout_construct($layout, $generator)
    {
        if(class_exists($layout)) {
            return new $layout($generator);
        }

        throw new \Exception('The Layout class wasn\'t found.');
    }

    /**
     * Factory for Drawer Classes
     *
     * @param $drawer string The classname of the Drawing Library Class
     */
    protected static function drawer_construct($drawer)
    {
        if(class_exists($drawer)) {
            return new $drawer();
        } else {
            if (class_exists("Imagick")) {
                // If Imagick is installed
                return new \Imagine\Imagick\Imagine();
            } elseif (function_exists('imagecolorallocate')) {
                // If Gd is Installed
                return new \Imagine\Gd\Imagine();
            } else {
                throw new \Exception('Neither ImageMagik nor PHP GD is installed.');
            }
        }
    }

    /**
     * Factory for Stlye Classes
     *
     * @param $layout string The classname of the Style
     * @param $layout Generator A Layout Object
     * @param $generator Generator A Generator Object
     * @param $drawer Generator A Drawer Object
     */
    protected static function style_construct($style, $layout, $generator, $drawer)
    {
        if(class_exists($style)) {
            return new $style($layout, $generator, $drawer);
        }

        throw new \Exception('The Stlye class wasn\'t found.');
    }

  	/**
    * Factory for Avity.
    *
    * @param $generator string|callback The Generator Class to be Used
    * @param $layout string|callback The Layout Class to be Used
    * @param $style string|callback The Style Class to be Used
    * @param $drawer string|callback The Drawing Class to be Used
    */
  	public static function init($options = [])
    {
        $options = array_merge([
            'generator' => '\\Hedronium\\Avity\\Generators\\Hash',
            'layout' => '\\Hedronium\\Avity\\Layouts\\VerticalMirror',
            'style' => '\\Hedronium\\Avity\\Styles\\Square',
            'drawer' => ''
        ], $options);

        $generator = $options['generator'];
        $layout = $options['layout'];
        $style = $options['style'];
        $drawer = $options['drawer'];

        $generator_obj = null;
      	$layout_obj = null;
      	$style_obj = null;
        $drawer_obj = null;

        if (is_callable($generator)) {
            $generator_obj = $generator();
        } else {
            $generator_obj = static::generator_construct($generator);
        }

        if (is_callable($layout)) {
            $layout_obj = $layout($generator_obj);
        } else {
            $layout_obj = static::layout_construct($layout, $generator_obj);
        }

        if (is_callable($drawer)) {
            $drawer_obj = $drawer();
        } else {
            $drawer_obj = static::drawer_construct($drawer);
        }

        if (is_callable($style)) {
            $style_obj = $style($layout_obj, $generator_obj, $drawer_obj);
        } else {
            $style_obj = static::style_construct($style, $layout_obj, $generator_obj, $drawer_obj);
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
