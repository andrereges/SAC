<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\ORMInvalidArgumentException;

use AppBundle\Entity\Chamado;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Pedido;

use AppBundle\Util\FiltroChamado;

class ChamadoController extends Controller {   

    /**
        * @Route("/chamado/lista/", name="chamado-lista")
        * @Route("/chamado/lista/")
     */
    public function lista(Request $request, FiltroChamado $filtro) {
        
        $limite = 5;
        $pagina = $request->get('pagina');
        $email =  strtolower($request->get('filtroPorEmail'));
        $pedido_numero =  $request->get('filtroPorPedido');
 
        if($pagina < 1) {
            $pagina = 1;
        }
        
        $query = $filtro->getQuery($email, $pedido_numero);

        if ($query) {

            $paginator = new Paginator($query);
            $paginator->getQuery()
                    ->setFirstResult($limite * ($pagina - 1))
                    ->setMaxResults($limite);

            $qtd_paginas = $this::calculaNumeroDePaginas($paginator, $limite);

        } else {
            $qtd_paginas = 1;
            $paginator = null;
        }

        return $this->render('chamado/lista.html.twig', 
                                    array('chamados' => $paginator, 
                                        'qtd_paginas' => $qtd_paginas,
                                            'pagina_atual' => $pagina,
                                                'pedido_numero' => $pedido_numero,
                                                    'email' => $email));
    }

    /**
     * @Route("/chamado/cadastro", name="chamado-cadastro")
     * @Route("/chamado/cadastro/", name="chamado-cadastro")
     */
    public function cadastroAction(Request $request) {  

        return $this->render('chamado/cadastro.html.twig');
   
    }

    /**
     * @Route("/chamado/adiciona", name="chamado-adiciona")
     */
    public function adicionaAction(Request $request, EntityManagerInterface $em){
        
        // Pega dados do formulário
        $pedidoId = $request->get('id_pedido');
        $clienteId = $request->get('id_cliente');
        $titulo = $request->get('titulo');
        $observacao = $request->get('observacao');

        // Testa Se existe Pedido, caso não, retorna para o formulário
        if(empty($pedidoId)) {

            // Redireciona para o formulário de cadastro com a mensagem de erro.
            $this::flashMessage('error', 'Falha. Chamado não foi cadastrado, número do pedido não encontrado!');
            return $this->redirect('/chamado/cadastro');
        }

        // Pega pedido e cliente(caso não exista cria um) no banco de dados
        $pedido = $em->getRepository('AppBundle:Pedido')->find($pedidoId);
        if(empty($clienteId)) {

            $email = $request->get('email');
            $nome = $request->get('nome');
            $cliente = new Cliente($email, $nome);

        } else {

            $cliente = $em->getRepository('AppBundle:Cliente')->find($clienteId);
        }

        // Cria chamado e grava no banco de dados
        $chamado = new Chamado();
        $chamado->setPedido($pedido);
        $chamado->setCliente($cliente);
        $chamado->setTitulo($titulo);
        $chamado->setObservacao($observacao);

        $em->persist($chamado);
        $em->flush();
        
        // Redireciona para o formulário de cadastro com a mensagem de sucesso.
        $this::flashMessage('sucesso', 'Sucesso. Chamado cadastrado');
        return $this->redirect('/chamado/cadastro');
    }

    private function calculaNumeroDePaginas($qtdChamados, $limitePorPagina) {
        
        $qtd_paginas = sizeof($qtdChamados) / $limitePorPagina; //2,6
        
        if(!is_int($qtd_paginas)) {
            
            $qtd_paginas = floor($qtd_paginas);
            $qtd_paginas = $qtd_paginas + 1;
            
        }

        return $qtd_paginas;
    }

    private function flashMessage($titulo, $mensagem) {

        $this->get('session')->getFlashBag()->set($titulo, $mensagem);
    }

}
