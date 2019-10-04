<?php

namespace Util;

use Zend\Hydrator\ReflectionHydrator;

trait EntityHydratorTrait {

    public function exchangeArray(array $data){
        return (new ReflectionHydrator())->hydrate($data, $this);
    }
}