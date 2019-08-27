<?php

namespace Cadastro\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use JsonSerializable;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * @ORM\Entity(repositoryClass="Cadastro\Repository\RemedioRepository")
 * @ORM\Table(name="remedio")
 */
class Remedio implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     * @var string
     */
    private $nome;

    /**
     * @ORM\Column(name="descricao", type="text", nullable=false, length=500)
     * @var string
     */
    private $descricao;

    /**
     * @ORM\Column(name="preco", type="float", nullable=false)
     * @var float
     */
    private $preco;


    public function jsonSerialize()
    {
        return [
            'id'        =>  $this->getId(),
            'nome'      =>  $this->getNome(),
            'descricao' =>  $this->getDescricao(),
            'preco'     =>  $this->getPreco()
        ];
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function validate()
    {
        if (!$this->nome)
            throw new Exception("Nome é uma informação obrigatoria");

        if (!$this->descricao)
            throw new Exception("Descrição é uma informação obrigatoria");

        if (!$this->preco)
            throw new Exception("Preço é uma informação obrigatoria");

        if (!is_float($preco))
            throw new Exception("Preço está em um formato inválido");

        if (!(new NotEmpty())->isValid($this->nome))
            throw new Exception("Nome não pode ser vazio");

        if (!(new NotEmpty())->isValid($this->descricao))
            throw new Exception("Nome não pode ser vazio");

        if (!(new StringLength(['max' => 100]))->isValid($this->nome))
            throw new Exception("Nome excede os limites de caracteres");

        if (!(new StringLength(['max' => 500]))->isValid($this->descricao))
            throw new Exception("Nome excede os limites de caracteres");
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
     * Get the value of descricao
     *
     * @return  string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     *
     * @param  string  $descricao
     *
     * @return  self
     */
    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of preco
     *
     * @return  float
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set the value of preco
     *
     * @param  float  $preco
     *
     * @return  self
     */
    public function setPreco(float $preco)
    {
        $this->preco = $preco;

        return $this;
    }
}
