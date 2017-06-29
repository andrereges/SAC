<?php

namespace AppBundle\Util;
use Doctrine\ORM\EntityManagerInterface;

class FiltroChamado {

    private $em;

    public function __construct(EntityManagerInterface $em) {

        $this->em = $em;
    }

    // Escolhe a query correta
    public function getQuery($email, $pedido_numero) {

        // Busca cliente e pedido no banco de dados
        $cliente = $this::getClienteNoBD($email);
        $pedido = $this::getPedidoNoBD($pedido_numero);

        // Verifica se existe a query foi construída
        $isQuery = $this::isExisteQuery($email, $pedido_numero, $cliente, $pedido);

        // Retorna a query nula ou com os valores
        if(!$isQuery) {
            return $query = null;
        } else {
            $query = $this::escolheQueryCorreta($cliente, $pedido);
            return $query;
        }

    } 


    private function getClienteNoBD($email) {

        if($email){    
            
            $cliente = $this->em-> getRepository('AppBundle:Cliente')->createQueryBuilder('c')
                            ->where('c.email = :email')
                            ->setParameter('email', $email)
                            ->getQuery()
                            ->getResult();
            return $cliente;
        }
        return null;
    }

    private function getPedidoNoBD($pedido_numero) {
        
        if($pedido_numero){    
            $pedido = $this->em->getRepository('AppBundle:Pedido')
                        ->findByNumero($pedido_numero);

            return $pedido;
        }
        return null;
    }
    
    private function isExisteQuery($email, $pedido_numero, $cliente, $pedido){

        if(($cliente && $pedido) 
            || ($cliente || $pedido) 
                    || (!$email && !$pedido_numero)) {
            
            if($cliente && $pedido || (!$email || !$pedido_numero)) {

                
            }else {
                return false;
            }

        }else {
            return false;
        }

        return true;
    }
    
    private function escolheQueryCorreta($cliente, $pedido) {

        if($cliente && $pedido) {
            $query = $this::queryCompleta($pedido, $cliente);
        } if (!$cliente && $pedido) {
            $query = $this::queryComPedido($pedido);
        } if (!$pedido && $cliente) {
            $query = $this::queryComCliente($cliente);
        }  if (!$cliente && !$pedido) {
            $query = $this::querySemArgumento();
        } 

        return $query;
    }
   

   // ____________ Functions Contrutoras de Queries ______________________________//

    private function queryCompleta($pedido, $cliente) {
        
        $query = $this->em->createQuery(
                    'SELECT ch FROM AppBundle:Chamado ch 
                        JOIN ch.pedido p 
                            JOIN ch.cliente c 
                                WHERE  p.id = :id_pedido
                                    AND c.id = :id_cliente
                                        ORDER BY ch.id DESC'                                            
                )->setParameter('id_pedido', $pedido)
                 ->setParameter('id_cliente', $cliente);

        return $query;
    }

    private function queryComPedido($pedido) {
        
        $query = $this->em->createQuery(
                    'SELECT ch FROM AppBundle:Chamado ch 
                        JOIN ch.pedido p 
                                WHERE  p.id = :id_pedido
                                    ORDER BY ch.id DESC'                                          
                )->setParameter('id_pedido', $pedido);

        return $query;
    }

    private function queryComCliente($cliente) {
        
        $query = $this->em->createQuery(
                    'SELECT ch FROM AppBundle:Chamado ch 
                            JOIN ch.cliente c 
                                WHERE  c.id = :id_cliente
                                    ORDER BY ch.id DESC'                                          
                )->setParameter('id_cliente', $cliente);

        return $query;
    }

    private function querySemArgumento() {
        
        $query = $this->em->createQuery('SELECT ch FROM AppBundle:Chamado ch ORDER BY ch.id DESC');

        return $query;
    }

}
