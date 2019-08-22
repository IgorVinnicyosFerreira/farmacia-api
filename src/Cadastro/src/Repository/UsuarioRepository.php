<?php

namespace Cadastro\Repository;

use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityRepository;
use Exception;

class UsuarioRepository extends EntityRepository
{
    public function save(Usuario $usuario)
    {
        if ($usuario->getId()) {

            $resultado = $this->find($usuario->getId());

            if (!$resultado) throw new Exception("Não existe um usuário para este id");

            $this->_em->merge($usuario);
            $this->_em->flush();
            return;
        }

        $this->_em->persist($usuario);
        $this->_em->flush();
    }

    public function delete(int $id)
    {
        $usuario = $this->find($id);

        if (!$usuario) throw new Exception("Não existe um usuário para este id");

        $this->_em->remove($usuario);
        $this->_em->flush();
    }
}
