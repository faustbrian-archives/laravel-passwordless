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

namespace Konceiver\Passwordless\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Konceiver\Passwordless\Enums\AuthSession;
use Laravel\Fortify\Contracts\LoginResponse;

final class StorePasswordlessController
{
    public function __invoke(Request $request)
    {
        if (Session::get(AuthSession::PASSPHRASE_EXPIRATION) < now()->timestamp) {
            Auth::logout();

            $this->clearSession($request);

            return redirect()
                ->route('login')
                ->withErrors(['passphrase' =>['Your passphrase has expired.']]);
        }

        if ($request->get('passphrase') !== Session::get(AuthSession::PASSPHRASE)) {
            throw ValidationException::withMessages([
                'passphrase' => ['The given passphrase is invalid.'],
            ]);
        }

        $this->clearSession($request);

        return resolve(LoginResponse::class);
    }

    private function clearSession($request): void
    {
        $request->session()->forget(AuthSession::PASSPHRASE);
        $request->session()->forget(AuthSession::PASSPHRASE_EXPIRATION);
    }
}
