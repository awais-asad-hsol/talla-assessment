<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Gate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->booted(function () {
        // ---- Employee Test Page 1 ----
        Gate::define('employee_test_page_1_view', fn ($user) => $user?->can('employee_test_page_1_view') ?? false);
        Gate::define('employee_test_page_1_add', fn ($user) => $user?->can('employee_test_page_1_add') ?? false);
        Gate::define('employee_test_page_1_delete', fn ($user) => $user?->can('employee_test_page_1_delete') ?? false);

        // ---- Employee Test Page 2 ----
        Gate::define('employee_test_page_2_view', fn ($user) => $user?->can('employee_test_page_2_view') ?? false);
        Gate::define('employee_test_page_2_add', fn ($user) => $user?->can('employee_test_page_2_add') ?? false);
        Gate::define('employee_test_page_2_delete', fn ($user) => $user?->can('employee_test_page_2_delete') ?? false);

        // ---- Employee Test Page 3 ----
        Gate::define('employee_test_page_3_view', fn ($user) => $user?->can('employee_test_page_3_view') ?? false);
        Gate::define('employee_test_page_3_add', fn ($user) => $user?->can('employee_test_page_3_add') ?? false);
        Gate::define('employee_test_page_3_delete', fn ($user) => $user?->can('employee_test_page_3_delete') ?? false);
    })
    ->create();
