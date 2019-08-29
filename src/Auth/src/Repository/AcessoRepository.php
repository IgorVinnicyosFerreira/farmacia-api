<?php

namespace Auth\Repository;

use Auth\Model\Entity\Acesso;
use Auth\Model\Entity\PerfilPermissao;
use Auth\Model\Entity\Permissao;
use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Exception;
use Zend\Crypt\Password\Bcrypt;

class AcessoRepository extends EntityRepository
{

    public function login(string $login, string $senha): Acesso
    {
        $acesso =  $this->findOneBy(["login" => $login]);

        if (!$acesso) throw new Exception("Login inválido");

        $bcrypt = new Bcrypt();

        if (!$bcrypt->verify($senha, $acesso->getSenha()))
            throw new Exception("Senha inválida");

        return $acesso;
    }

    public function getPermissionsByAccess(Acesso $acesso): array
    {
        $query = $this->_em->createQueryBuilder();
        $query->select(['p.rota'])->from(PerfilPermissao::class, 'per_perm')
            ->leftJoin(Permissao::class, 'p', 'WITH', 'p.id = per_perm.permissao')
            ->where('per_perm.perfil = :idperfil')
            ->setParameter('idperfil', $acesso->getPerfil()->getId());

        $result = $query->getQuery()->getArrayResult();

        return $result;
    }


    public function a()
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->create("123456");
    }
}
