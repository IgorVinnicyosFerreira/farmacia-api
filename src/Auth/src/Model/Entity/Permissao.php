<?php

namespace Auth\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="Auth\Repository\PermissaoRepository")
 * @ORM\Table(name="permissao")
 */
class Permissao implements JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nome", type="string", length= 50, nullable=false)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(name="rota", type="string", nullable=false)
     * @var string
     */
    private $rota;

    public function jsonSerialize()
    {
        return [
            "nome" => $this->getNome(),
            "rota" => $this->getRota()
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
     * Get the value of rota
     *
     * @return  string
     */
    public function getRota()
    {
        return $this->rota;
    }

    /**
     * Set the value of rota
     *
     * @param  string  $rota
     *
     * @return  self
     */
    public function setRota(string $rota)
    {
        $this->rota = $rota;

        return $this;
    }
}
