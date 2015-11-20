<?php
namespace Hedronium\Avity\Generators;

use Hedronium\Avity\Generator;

class Hash extends Generator
{
    protected $hash = "";

    public function hash($str)
    {
        $this->hash = crc32($str);
        srand($this->hash);
    }

    public function shouldDraw($x, $y)
    {
        return (bool) rand(0, 1);
    }
}
