<?php

namespace Cadastro\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="Cadastro\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 */
class Usuario implements JsonSerializable
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
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * mapeamento bidirecional com entidade Compra
     * um usuário pode ter feito N vendas
     * @ORM\OneToMany(targetEntity="App\Entity\Compra", mappedBy="usuario")
     */
    private $vendas;

    public function jsonSerialize()
    {
        return [
            'id'             => $this->getId(),
            'nome'           => $this->getNome(),
            'sobrenome'      => $this->getSobrenome(),
            'email'          => $this->getEmail(),
            'dataNascimento' => $this->getDataNascimento(),
            'vendas'         => $this->getVendas()
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
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get mapeamento bidirecional com entidade Compra
     */
    public function getVendas()
    {
        return $this->vendas;
    }

    /**
     * Set mapeamento bidirecional com entidade Compra
     *
     * @return  self
     */
    public function setVendas($vendas)
    {
        $this->vendas = $vendas;

        return $this;
    }
}
