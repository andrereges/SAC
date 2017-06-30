<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Chamado;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Cliente;

class Load3ChamadoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {   

        $numeros = array(   130, 
                            121,
                            122,
                            130,
                            125,
                            122,
                            122,
                            128,
                            129, 
                            121,
                            123, 
                            126,
                            124,
                            127

                        );

        $emails = array(    'nazevedo@gmail.com',
                            'wsafadao@gmail.com', 
                            'glima@gmail.com',
                            'ecosta@gmail.com',
                            'phenrique@gmail.com',
                            'wsafadao@gmail.com',
                            'ecosta@gmail.com',
                            'phenrique@gmail.com',
                            'mmendonca@gmail.com',
                            'lsantana@gmail.com',
                            'jneto@gmail.com',
                            'llima@gmail.com',
                            'zdcamargo@gmail.com',
                            'mmendonca@gmail.com' 

                        );

        $titulos = array(   'Monitor não liga', 
                            'Teclado com defeito', 
                            'Mouse com problemas', 
                            'Notebook esquentando', 
                            'Fonte de notebook com defeito',
                            'Monitor com led piscando',
                            'Botão do mouse quebrado',
                            'Roteador não liga',
                            'Tablet não carrega bateria',
                            'Antena de roteador ruim',
                            'Monitor com led piscando',
                            'Botão do mouse quebrado',
                            'Antena de roteador ruim',
                            'Mouse com problemas'
                        );
        
        $observacoes = array(   'Efetuado todos os testes mas sem sucesso', 
                                'Enviado outro teclado para o cliente', 
                                'Trocado mouse', 
                                'Encaminhado para assistência técnica', 
                                'Efetuado troca da fonte',
                                'Encaminhado para assistência técnica',
                                'Efetuado troca do mouse',
                                'Efetuado testes, mas sem sucesso',
                                'Trocado fonte de alimentação',
                                'Trocado roteador',
                                'Efetuado todos os testes mas sem sucesso',
                                'Encaminhado para assistência técnica',
                                'Trocado roteador',
                                'Efetuado troca do mouse'
                        );


        $chamados = array();

        for($i= 0; $i < 13; $i++) {

            $cliente = $manager->getRepository('AppBundle:Cliente')->findOneByEmail($emails[$i]);
            $pedido = $manager->getRepository('AppBundle:Pedido')->findOneByNumero($numeros[$i]);
            
            $chamado = new Chamado();
            $chamado->setCliente($cliente);
            $chamado->setPedido($pedido);
            $chamado->setTitulo($titulos[$i]);
            $chamado->setObservacao($observacoes[$i]);

            array_push($chamados , $chamado);
        }
                                
        foreach($chamados as $chamado) {

            $manager->persist($chamado);
            $manager->flush();
        }        
    }
}