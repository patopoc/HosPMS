<?php

namespace Hotpms\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Hotpms\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Hotpms\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Hotpms\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Hotpms\Http\Middleware\RedirectIfAuthenticated::class,
    	'is_admin' => \Hotpms\Http\Middleware\IsAdmin::class,
    	'is_user' => \Hotpms\Http\Middleware\IsUser::class,
    	'access_control' => \Hotpms\Http\Middleware\AccessControl::class,
    	'set_current_property' => \Hotpms\Http\Middleware\SetCurrentProperty::class,
    	'set_current_section' => \Hotpms\Http\Middleware\SetCurrentSection::class,
    ];
}
