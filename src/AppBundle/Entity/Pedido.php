<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="pedidos")
 */
class Pedido {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false, unique=true)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="Chamado", mappedBy="pedido")
     */
    protected $chamados;

    public function __construct($numero= 0)
    {   
        $this->numero = $numero;
        
        $this->chamados = new ArrayCollection();
    }

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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Pedido
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Add chamado
     *
     * @param \AppBundle\Entity\Chamado $chamado
     *
     * @return Pedido
     */
    public function addChamado(\AppBundle\Entity\Chamado $chamado)
    {
        $this->chamados[] = $chamado;

        return $this;
    }

    /**
     * Remove chamado
     *
     * @param \AppBundle\Entity\Chamado $chamado
     */
    public function removeChamado(\AppBundle\Entity\Chamado $chamado)
    {
        $this->chamados->removeElement($chamado);
    }

    /**
     * Get chamados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChamados()
    {
        return $this->chamados;
    }
}
