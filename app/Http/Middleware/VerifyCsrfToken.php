<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/register',
        'api/login',
        'api/users',
        'api/users/*',
        'api/accounts',
        'api/currencies',
        'api/currencies/*',
        'api/transactions',
        'api/transactions/*',
        'api/goals',
        'api/goals/*',
    ];
}
