<?php
use Hedronium\Avity\Generators\Hash;
use Mockery as M;

class HashTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }

    public function testSameHash()
    {
        $generator_a = new Hash();
        $generator_a->hash('NIGGA');

        $generator_b = new Hash();
        $generator_b->hash('NIGGA');

        $cycles = 10;
        while ($cycles--) {
            $this->assertSame(
                $generator_a->next($cycles, -1*$cycles),
                $generator_b->next($cycles, -1*$cycles)
            );
        }
    }

    public function testDifferentHash()
    {
        $generator_a = new Hash();
        $generator_a->hash('NIGGA');

        $generator_b = new Hash();
        $generator_b->hash('WHITE NIGGA');

        $seq_a = [];
        $seq_b = [];

        $cycles = 10;
        while ($cycles--) {
            array_push($seq_a, $generator_a->next($cycles, -1*$cycles));
            array_push($seq_b, $generator_b->next($cycles, -1*$cycles));
        }

        $this->assertNotEquals($seq_a, $seq_b);
    }
}
