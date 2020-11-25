<?php

declare(strict_types=1);

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\App;
use Konceiver\Passwordless\Http\Middleware\PassphraseGuard;

it('should register the guard middleware', function (): void {
    expect(App::make(Kernel::class)->hasMiddleware(PassphraseGuard::class))->toBeTrue();
});
