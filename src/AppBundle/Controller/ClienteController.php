<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Cliente;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClienteController extends Controller
{
    /**
     * @Route("/cliente", name="cliente-lista")
     */
    public function listaAction(Request $request, EntityManagerInterface $em){  

        $repository = $em->getRepository('AppBundle:Cliente');
        $clientes = $repository->findAll();

        if (empty($clientes)) {
            throw $this->createNotFoundException(
                'Nenhum cliente encontrado'
            );
        }

        return new Response($clientes[1]->getNome());// $this->render('cliente/lista.html.twig', $clientes );
    }

    /**
     * @Route("/cliente/adiciona", name="cliente-adiciona")
     */
    public function adicionaAction(Request $request, EntityManagerInterface $em){

        $cliente = new Cliente();
        $cliente->setEmail('dreeh.silva@hotmail.com');
        $cliente->setNome('Andre Riggs2');

        $em->persist($cliente);
        $em->flush();

        return new Response('Cliente salvo com sucesso. Seu id é '.$cliente->getId()); 
    
    }

    /**
     * @Route("/cliente/{clienteEmail}", name="cliente-busca")
     */
    public function buscaClientePorEmailAction($clienteEmail, EntityManagerInterface $em) {

        $cliente = $em->getRepository('AppBundle:Cliente')->findOneByEmail($clienteEmail);

        if (empty($cliente)) {
            throw $this->createNotFoundException(
                'Nenhum cliente encontrado com o id '.$clienteEmail
            );
        }

        $clienteJson = array('id' => $cliente->getId(), 'nome' => $cliente->getNome());

        return new JsonResponse($clienteJson);
    }

}
