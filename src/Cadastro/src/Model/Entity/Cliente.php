<?php

namespace Cadastro\Model\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use JsonSerializable;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * @ORM\Entity(repositoryClass="Cadastro\Repository\ClienteRepository")
 * @ORM\Table(name="cliente")
 */
class Cliente implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nome", type="string", length=50, nullable=false)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(name="sobrenome", type="string", length=50, nullable=false)
     * @var string
     */
    private $sobrenome;

    /**
     * @ORM\Column(name="dataNascimento", type="date", nullable=false);
     * @var DateTime
     */
    private $dataNascimento;

    /**
     * mapeamento bidirecional com entidade Compra
     * um cliente pode ter feito N compras
     * @ORM\OneToMany(targetEntity="App\Model\Entity\Compra", mappedBy="cliente")
     */
    private $compras;

    public function __construct()
    {
        $this->compras = new ArrayCollection();
    }

    public function jsonSerialize()
    {
        return [
            'id'             => $this->getId(),
            'nome'           => $this->getNome(),
            'sobrenome'      => $this->getSobrenome(),
            'dataNascimento' => $this->getDataNascimento(),
            'compras'        => $this->getCompras()
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
     * Get the value of nome
     *
     * @return  string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param  string  $nome
     *
     * @return  self
     */
    public function setNome(string $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of sobrenome
     *
     * @return  string
     */
    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    /**
     * Set the value of sobrenome
     *
     * @param  string  $sobrenome
     *
     * @return  self
     */
    public function setSobrenome(string $sobrenome)
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Get the value of dataNascimento
     * @return DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set the value of dataNascimento
     *
     * @return  self
     */
    public function setDataNascimento(string $dataNascimento)
    {
        $this->dataNascimento = new DateTime($dataNascimento);

        return $this;
    }

    /**
     * Get mapeamento bidirecional com entidade Compra
     */
    public function getCompras()
    {
        return $this->compras->toArray();
    }

    /**
     * Set mapeamento bidirecional com entidade Compra
     *
     * @return  self
     */
    public function setCompras($compras)
    {
        $this->compras = $compras;

        return $this;
    }
}
