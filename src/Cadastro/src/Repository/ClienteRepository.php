<?php

namespace Cadastro\Repository;

use Cadastro\Model\Entity\Cliente;
use Exception;
use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository
{

    public function save(Cliente $cliente)
    {

        if ($cliente->getId()) {
            $resultado = $this->find($cliente->getId());

            if (!$resultado) throw new Exception("Cliente inexistente");
        }

        $this->_em->merge($cliente);
        $this->_em->flush();
    }

    public function delete(int $id)
    {
        $cliente = $this->find($id);

        if (!$cliente) throw new Exception("Não existe um cliente para este id");

        if (!empty($cliente->getCompras()))
            throw new Exception("Existem compras vinculadas a este cliente");

        $this->_em->remove($cliente);
        $this->_em->flush();
    }
}
