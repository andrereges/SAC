<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Cliente;

class Load2ClienteData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $clientes = array( 
                           new Cliente('phenrique@gmail.com', 'Pedro Henrique'),
                           new Cliente('llima@gmail.com', 'Lucas Lima'),
                           new Cliente('jneto@gmail.com', 'João Neto'),
                           new Cliente('ecosta@gmail.com', 'Eduardo Costa'),
                           new Cliente('zdcamargo@gmail.com', 'Zezé de Camargo'),
                           new Cliente('glima@gmail.com', 'Gusttavo Lima'),
                           new Cliente('mmendonca@gmail.com', 'Marília Mendonça'),
                           new Cliente('wsafadao@gmail.com', 'Wesley Safadão'),
                           new Cliente('lsantana@gmail.com', 'Luan Santana'),
                           new Cliente('nazevedo@gmail.com', 'Naiara Azevedo')
                         );

        foreach($clientes as $cliente) {

            $manager->persist($cliente);
            $manager->flush();
        }        
    }
}