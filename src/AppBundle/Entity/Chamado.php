<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="chamados")
 */
class Chamado {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="pedido")
     * @ORM\JoinColumn(name="pedido_id", referencedColumnName="id")
     */
    protected $pedido;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="cliente", cascade={"persist"})
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    protected $cliente;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $titulo;
    
    /**
     * @ORM\Column(type="text")
     */
    private $observacao;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Chamado
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return Chamado
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set pedido
     *
     * @param \AppBundle\Entity\Pedido $pedido
     *
     * @return Chamado
     */
    public function setPedido(\AppBundle\Entity\Pedido $pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return \AppBundle\Entity\Pedido
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     *
     * @return Chamado
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }
}
