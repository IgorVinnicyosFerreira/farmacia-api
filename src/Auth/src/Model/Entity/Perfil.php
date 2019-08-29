<?php

namespace Auth\Model\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="Auth\Repository\PerfilRepository");
 * @ORM\Table(name="perfil")
 */
class Perfil implements JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nome",type="string", length=50,nullable = false)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(name="ativo", type="boolean", nullable = false, options={"default": true})
     * @var bool
     */
    private $ativo;

    /**
     * @ORM\OneToMany(targetEntity="PerfilPermissao", mappedBy="perfil")
     * @var ArrayCollection
     */
    private $perfilPermissao;

    public function __construct()
    {
        $this->perfilPermissao = new ArrayCollection();
    }

    public function jsonSerialize()
    {
        return [
            "nome" => $this->getNome(),
            "ativo" => $this->getAtivo()
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
     * Get the value of ativo
     *
     * @return  bool
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set the value of ativo
     *
     * @param  bool  $ativo
     *
     * @return  self
     */
    public function setAtivo(bool $ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Get the value of perfilPermissao
     *
     * @return  ArrayCollection
     */
    public function getPerfilPermissao()
    {
        return $this->perfilPermissao;
    }

    /**
     * Set the value of perfilPermissao
     *
     * @param  ArrayCollection  $perfilPermissao
     *
     * @return  self
     */
    public function setPerfilPermissao(ArrayCollection $perfilPermissao)
    {
        $this->perfilPermissao = $perfilPermissao;

        return $this;
    }
}
