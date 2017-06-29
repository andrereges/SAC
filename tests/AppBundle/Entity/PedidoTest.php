<?php
namespace Tests\AppBundle\Util;

use AppBundle\Entity\Pedido;
use PHPUnit\Framework\TestCase;

class PedidoTest extends TestCase
{
    public function testAdd()
    {
        $calc = new Calculator();
        $result = $calc->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}