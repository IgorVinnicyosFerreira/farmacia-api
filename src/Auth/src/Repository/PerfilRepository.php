<?php

namespace Auth\Repository;

use Auth\Model\Entity\Perfil;
use Auth\Model\Entity\PerfilPermissao;
use Doctrine\ORM\EntityRepository;

class PerfilRepository extends EntityRepository
{

    public function getPermissionsByPerfil(Perfil $perfil)
    {
        $permissoes = $perfil->getPerfilPermissao()->map(
            function (PerfilPermissao $perfilPermissao) {
                return $perfilPermissao->getPermissao();
            }
        );

        return $permissoes->getValues();
    }
}
