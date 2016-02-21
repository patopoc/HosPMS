<?php

namespace Hospms\Http;

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
        \Hospms\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Hospms\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Hospms\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \Hospms\Http\Middleware\RedirectIfAuthenticated::class,
    	'is_admin' => \Hospms\Http\Middleware\IsAdmin::class,
    	'is_user' => \Hospms\Http\Middleware\IsUser::class,
    	'access_control' => \Hospms\Http\Middleware\AccessControl::class,
    	'set_current_property' => \Hospms\Http\Middleware\SetCurrentProperty::class,
    	'set_current_section' => \Hospms\Http\Middleware\SetCurrentSection::class,
    ];
}
