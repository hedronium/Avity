<?php
namespace Hedronium\Avity\Generators;

use Hedronium\Avity\Generator;

/**
 *  Random Generator
 */
class Random extends Generator
{
    public function next($x, $y)
    {
        return mt_rand();
    }
}
