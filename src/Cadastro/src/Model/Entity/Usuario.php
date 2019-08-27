<?php

namespace Cadastro\Model\Entity;

use Auth\Model\Entity\Acesso;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use JsonSerializable;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

/**
 * @ORM\Entity(repositoryClass="Cadastro\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\OneToMany(targetEntity="App\Model\Entity\Compra", mappedBy="usuario")
     */
    private $vendas;

    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(
     * targetEntity="Auth\Model\Entity\Acesso", 
     * mappedBy="usuario",
     * cascade={"persist", "remove"}
     * )
     */
    private $acesso;

    public function jsonSerialize()
    {
        return [
            'id'             => $this->getId(),
            'nome'           => $this->getNome(),
            'sobrenome'      => $this->getSobrenome(),
            'email'          => $this->getEmail(),
            'dataNascimento' => $this->getDataNascimento(),
        ];
    }

    public function __construct()
    {
        $this->vendas = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function validate()
    {
        if (!$this->nome)
            throw new Exception("Nome é uma informação obrigatória");

        if (!$this->sobrenome)
            throw new Exception("Sobrenome é uma informação obrigatória");

        if (!$this->dataNascimento)
            throw new Exception("Data nascimento é uma informação obrigatória");

        if (!$this->email)
            throw new Exception("Email é uma informação obrigatória");

        if (!(new EmailAddress())->isValid($this->email))
            throw new Exception("Email inválido");

        if (!(new NotEmpty())->isValid($this->nome))
            throw new Exception("Nome não pode ser vazio");

        if (!(new NotEmpty())->isValid($this->sobrenome))
            throw new Exception("Sobrenome não pode ser vazio");

        if (!(new NotEmpty())->isValid($this->email))
            throw new Exception("Sobrenome não pode ser vazio");

        if (!(new StringLength(["max" => 50]))->isValid($this->nome))
            throw new Exception("Nome excede o limite de caracteres");

        if (!(new StringLength(["max" => 50]))->isValid($this->sobrenome))
            throw new Exception("Sobrenome excede o limite de caracteres");
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
        $this->dataNascimento = new DateTime($dataNascimento);

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

    /**
     * Get one Cart has One Customer.
     * @return Acesso
     */
    public function getAcesso()
    {
        return $this->acesso;
    }

    /**
     * Set one Cart has One Customer.
     *
     * @return  self
     */
    public function setAcesso(Acesso $acesso)
    {
        $acesso->setUsuario($this);
        $this->acesso = $acesso;

        return $this;
    }
}
