<?php

namespace Auth\Repository;

use Auth\Model\Entity\Acesso;
use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityRepository;
use Exception;
use Zend\Crypt\Password\Bcrypt;

class AcessoRepository extends EntityRepository
{

    public function login(string $login, string $senha): Usuario
    {
        $acesso =  $this->findOneBy(["login" => $login]);

        if (!$acesso) throw new Exception("Login inválido");

        $bcrypt = new Bcrypt();

        if (!$bcrypt->verify($senha, $acesso->getSenha()))
            throw new Exception("Senha inválida");

        return $acesso->getUsuario();
    }
}
