<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pedido;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

class PedidoController extends Controller
{
    /**
     * @Route("/pedido/{pedidoNumero}", name="pedido-busca")
     */
    public function buscaPedidoPorIdAction($pedidoNumero, EntityManagerInterface $em) {
        
        $pedido = $em->getRepository('AppBundle:Pedido')->findOneByNumero($pedidoNumero);

        if (empty($pedido)) {
            throw $this->createNotFoundException(
                'Nenhum Pedido encontrado com o id '.$pedidoNumero
            );
        }
        
        $pedidoJson = array('id' => $pedido->getId());

        return new JsonResponse($pedidoJson);
    }

}
