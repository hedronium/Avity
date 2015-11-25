<?php
use Hedronium\Avity\Generators\Hash;
use Hedronium\Avity\Layout;

use Mockery as M;

class LayoutTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }

    public function testShouldDraw()
    {
        $generator = new Hash;
        $generator->hash('x');

        $generator_x = new Hash;
        $generator_x->hash('x');

        $layout = M::mock(Layout::class, [$generator]);

        $reflection =  new ReflectionClass(Layout::class);
        $method = $reflection->getMethod('shouldDraw');
        $method->setAccessible(true);

        $expected = (bool)$generator_x->next(1, 1)%2;
        $actual = $method->invokeArgs($layout, [[false, true], 1, 1]);

        $this->assertEquals($expected, $actual);
    }
}
