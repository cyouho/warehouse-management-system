<?php

define('AUTH_API_DOMAIN', 'localhost');
define('AUTH_API_PORT', ':9000');

return [
    'login' => constant('AUTH_API_DOMAIN') . constant('AUTH_API_PORT') . '/api/login',
    'register' => constant('AUTH_API_DOMAIN') . constant('AUTH_API_PORT') . '/api/register',
];
