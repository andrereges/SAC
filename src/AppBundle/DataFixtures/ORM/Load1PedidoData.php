<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Pedido;

class Load1PedidoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pedidos = array( 
                           new Pedido(120),
                           new Pedido(121),
                           new Pedido(122),
                           new Pedido(123),
                           new Pedido(124),
                           new Pedido(125),
                           new Pedido(126),
                           new Pedido(128),
                           new Pedido(129),
                           new Pedido(130)
                         );

        foreach($pedidos as $pedido) {
            
            $manager->persist($pedido);
            $manager->flush();
        }
        
         
    }
}