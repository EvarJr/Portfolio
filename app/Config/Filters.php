<?php

namespace Config;

use App\Filters\AuthFilter;
use CodeIgniter\Config\BaseConfig;

/**
 * app/Config/Filters.php
 *
 * Registers our 'auth' filter alias so it can be used in Routes.php
 * as ['filter' => 'auth']
 */
class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'          => \CodeIgniter\Filters\CSRF::class,
        'toolbar'       => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot'      => \CodeIgniter\Filters\Honeypot::class,
        'invalidchars'  => \CodeIgniter\Filters\InvalidChars::class,
        'secureheaders' => \CodeIgniter\Filters\SecureHeaders::class,
        'auth'          => AuthFilter::class,
    ];

    public array $globals = [
        'before' => [
            // Exclude all api/* routes from CSRF — they handle their own tokens.
            // Without this, CI4 rejects the token and redirects POST → GET,
            // causing "Can't find a route for GET: api/..." 404 errors.
            'csrf' => ['except' => ['login', 'api/*']],
        ],
        'after' => ['toolbar'],
    ];

    public array $methods = [];
    public array $filters = [];
}