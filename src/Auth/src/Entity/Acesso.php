<?php

namespace Auth\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Cadastro\Entity\Usuario;

/**
 * @ORM\Entity(repositoryClass="Auth\Repository\AcessoRepository")
 * @ORM\Table(name="acesso")
 */
class Acesso implements JsonSerializable
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(name="login", type="string", nullable=false)
     * @var string
     */
    private $login;

    /**
     * @ORM\Column(name="senha", type="string", nullable=false)
     * @var string
     */
    private $senha;

    /**
     * @ORM\OneToOne(targetEntity="Cadastro\Entity\Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", nullable=false)
     * @var Usuario
     */
    private $usuario;

    public function jsonSerialize()
    {
        return [
            'id'        =>  $this->getId(),
            'login'     =>  $this->getLogin(),
            'usuario'   =>  $this->getUsuario()
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
     * Get the value of login
     *
     * @return  string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @param  string  $login
     *
     * @return  self
     */
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of senha
     *
     * @return  string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @param  string  $senha
     *
     * @return  self
     */
    public function setSenha(string $senha)
    {
        $this->senha = $senha;

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
}
