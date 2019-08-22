<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Cadastro\Model\Entity\{Usuario, Cliente, Remedio};

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompraRepository")
 * @ORM\Table(name="compra")
 */
class Compra implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cadastro\Model\Entity\Usuario", inversedBy="vendas")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     * @var Usuario
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Cadastro\Model\Entity\Cliente", inversedBy="compras")
     * @ORM\JoinColumn(name="id_cliente", referencedColumnName="id")
     * @var Cliente
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Cadastro\Model\Entity\Remedio")
     * @ORM\JoinColumn(name="id_remedio", referencedColumnName="id")
     * @var Remedio
     */
    private $remedio;

    public function jsonSerialize()
    {
        return [
            "id"        =>  $this->getId(),
            "usuario"   =>  $this->getUsuario(),
            "cliente"   =>  $this->getCliente(),
            "remedio"   =>  $this->getRemedio()
        ];
    }

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of usuario
     *
     * @return  Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @param  Usuario  $usuario
     *
     * @return  self
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of cliente
     *
     * @return  Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of cliente
     *
     * @param  Cliente  $cliente
     *
     * @return  self
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get the value of remedio
     *
     * @return  Remedio
     */
    public function getRemedio()
    {
        return $this->remedio;
    }

    /**
     * Set the value of remedio
     *
     * @param  Remedio  $remedio
     *
     * @return  self
     */
    public function setRemedio(Remedio $remedio)
    {
        $this->remedio = $remedio;

        return $this;
    }
}
