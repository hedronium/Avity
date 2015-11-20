<?php
// Layout.php
namespace Hedronium\Avity;

use Hedronium\Avity\Generator;

abstract class Layout
{
    abstract public function drawGrid(Generator $gen);
}
