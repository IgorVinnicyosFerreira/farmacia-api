<?php

namespace Auth\Repository;

use Auth\Model\Entity\Acesso;
use Doctrine\ORM\EntityRepository;
use Exception;

class AcessoRepository extends EntityRepository
{

    public function save(Acesso $acesso)
    {
        if ($acesso->getId()) {

            $resultado = $this->find($acesso->getId());

            if (!$resultado) throw new Exception("Não existe um acesso para este id");
        }

        $this->_em->persist($acesso);
        $this->flush();
    }
}
