<?php

namespace Auth\JWT;

use Firebase\JWT\JWT as FirebaseJWT;
use Exception;
use Zend\Diactoros\Response\JsonResponse;

class JWT
{
    private $key;
    private $alg;
    private $expirationTime;
    private $iss;


    const DEFAULT_ALG = "HS256";

    public function __construct(array $jwtConfig)
    {
        if (!isset($jwtConfig['key']))
            throw new Exception("Chave de encriptação não definida");

        $this->key = $jwtConfig['key'];

        $this->alg = isset($jwtConfig['alg'])
            ? $jwtConfig['alg']
            : self::DEFAULT_ALG;

        if (isset($jwtConfig['expirationTime'])) {
            if (!is_int($jwtConfig['expirationTime']))
                throw new Exception("O tempo de expiração do token precisa ser especificado em numeros inteiros");

            $this->expirationTime =  $jwtConfig['expirationTime'];
        }

        if (isset($jwtConfig['iss']))
            $this->iss = $jwtConfig['iss'];
    }

    public function createToken($payload, array $permissions = null): string
    {
        if ($this->expirationTime)
            $payload['exp'] = strtotime("now +{$this->expirationTime} minutes");

        if ($this->iss)
            $payload['iss'] = $this->iss;

        if ($permissoes)
            $payload['permissions'] = $permissions;

        $payload["iat"] = strtotime("now");

        if (!key_exists($this->alg, FirebaseJWT::$supported_algs))
            throw new Exception("Alg não suportado");

        return FirebaseJWT::encode($payload, $this->key, $this->alg);
    }

    public function getTokenPayload(string $token): object
    {

        if (!key_exists($this->alg, FirebaseJWT::$supported_algs))
            throw new Exception("Alg não suportado");

        return FirebaseJWT::decode($token, $this->key, [$this->alg]);
    }

    public function tokenIsValid($token): bool
    {

        try {
            $token = $this->getTokenPayload($token);

            if ($this->expirationTime) {
                $tokenExpiration = $token->exp;
                $currentTime = strtotime('now');

                if ($tokenExpiration < $currentTime)
                    return false;
            }

            return true;
        } catch (Exception $error) {
            return false;
        }
    }

    public function tokenResponse(string $token): JsonResponse
    {
        $jsonResponse = new JsonResponse([]);
        return $jsonResponse->withHeader("authorization", "Bearer {$token}");
    }
}
