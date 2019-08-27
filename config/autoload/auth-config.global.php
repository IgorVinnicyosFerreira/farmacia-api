<?php

return [
    "authConfig" => [
        "jwt" => [
            "key" => "qwertyuiopasdfghjklzxcvbnm123456",
            "alg" => "HS256",
            "iss" => "https://www.farmacia.com",
            "expirationTime" => 1
        ],
        "ignoredRoutes" => ["login"]
    ]
];
