<?php

namespace App\Repository;

use App\Model\Entity\Compra;
use Cadastro\Model\Entity\Cliente;
use Cadastro\Model\Entity\Remedio;
use Cadastro\Model\Entity\Usuario;
use Doctrine\ORM\EntityRepository;
use Exception;

class CompraRepository extends EntityRepository
{
    public function save($idUsuario, $idRemedio, $idCliente)
    {
        $remedioRepository = $this->_em->getRepository(Remedio::class);
        $usuarioRepository = $this->_em->getRepository(Usuario::class);
        $clienteRepository = $this->_em->getRepository(Cliente::class);

        $remedio = $remedioRepository->find($idRemedio);
        if (!$remedio)
            throw new Exception("Não existe um rémedio cadastrado com este id");

        $usuario = $usuarioRepository->find($idUsuario);
        if (!$usuario)
            throw new Exception("Não existe um usuário cadastrado com este id");

        $cliente = $clienteRepository->find($idCliente);
        if (!$cliente)
            throw new Exception("Não existe um cliente cadastrado com este id");

        $compra = new Compra();
        $compra->setCliente($cliente);
        $compra->setRemedio($remedio);
        $compra->setUsuario($usuario);

        $this->_em->persist($compra);
        $this->_em->flush();
    }
}
