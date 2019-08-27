<?php

namespace Cadastro\Repository;

use Cadastro\Model\Entity\Remedio;
use Doctrine\ORM\EntityRepository;
use Exception;

class RemedioRepository extends EntityRepository
{

    public function save(Remedio $remedio)
    {
        if ($remedio->getId()) {
            $resultado = $this->find($remedio->getId());

            if (!$resultado) throw new Exception("Não existe um remedio para este id");
        }

        $this->_em->merge($remedio);
        $this->_em->flush();
    }

    public function delete(int $id)
    {
        $remedio = $this->find($id);

        if (!$remedio) throw new Exception("Não existe um remédio cadastrado para este id");

        $this->_em->remove($remedio);
        $this->_em->flush();
    }
}
