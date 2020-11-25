<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Passwordless.
 *
 * (c) Konceiver Oy <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Passwordless\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Konceiver\Passwordless\Enums\AuthSession;

final class PassphraseGuard
{
    public function handle(Request $request, Closure $next)
    {
        $passphrase = $request->session()->get(AuthSession::PASSPHRASE, null);

        if (is_null($passphrase)) {
            return $next($request);
        }

        if ($request->session()->get(AuthSession::PASSPHRASE_EXPIRATION) < now()->timestamp) {
            $request->session()->forget(AuthSession::PASSPHRASE);
            $request->session()->forget(AuthSession::PASSPHRASE_EXPIRATION);

            Auth::logout();

            return redirect('/');
        }

        if ($request->route()->named('login.*')) {
            return $next($request);
        }

        return redirect()->route('login.confirm');
    }
}
