<?php
// Style.php
namespace Hedronium\Avity;

abstract class Style
{
		public $height  = 300;
		public $width   = 300;
    public $padding = 40;

  		abstract public function draw(array $grid);
}
