<?php

namespace Auth\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="perfil_permissao")
 */
class PerfilPermissao
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Perfil", inversedBy="perfilPermissao")
     * @var Perfil
     */
    private $perfil;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Permissao");
     * @var Permissao
     */
    private $permissao;



    /**
     * Get the value of perfil
     *
     * @return  Perfil
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set the value of perfil
     *
     * @param  Perfil  $perfil
     *
     * @return  self
     */
    public function setPerfil(Perfil $perfil)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get the value of permissao
     *
     * @return  Permissao
     */
    public function getPermissao()
    {
        return $this->permissao;
    }

    /**
     * Set the value of permissao
     *
     * @param  Permissao  $permissao
     *
     * @return  self
     */
    public function setPermissao(Permissao $permissao)
    {
        $this->permissao = $permissao;

        return $this;
    }
}
