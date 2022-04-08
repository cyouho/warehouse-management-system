<?php

define('AUTH_API_DOMAIN', 'http://127.0.0.2');
define('AUTH_API_PORT', ':9000');

return [
    'login' => constant('AUTH_API_DOMAIN') . constant('AUTH_API_PORT') . '/api/login',
    'register' => constant('AUTH_API_DOMAIN') . constant('AUTH_API_PORT') . '/api/register',
    'check_login' => constant('AUTH_API_DOMAIN') . constant('AUTH_API_PORT') . '/api/authenticate',
    'logout' => constant('AUTH_API_DOMAIN') . constant('AUTH_API_PORT') . '/api/logout',
];
