<?php
// Style.php
namespace Hedronium\Avity;

abstract class Style
{
		public $height  = 300;
		public $width   = 300;
    public $padding = 40;

  	protected $layout = null;
  	protected $generator = null;

  	public function __construct(Layout $layout, Generator $generator)
    {
      	$this->layout = $layout;
      	$this->generator = $generator;
    }

  	protected function getGrid()
    {
      	return $this->layout->drawGrid();
    }

    abstract public function draw();
}
