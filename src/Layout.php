<?php
// Layout.php
namespace Hedronium\Avity;

use Hedronium\Avity\Gegnerator;

abstract class Layout
{
    abstract public function drawGrid(Generator $gen);
}
