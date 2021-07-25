<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Passwordless.
 *
 * (c) Konceiver <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Passwordless\Listeners;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Konceiver\Passphrase\EFF;
use Konceiver\Passwordless\Enums\AuthSession;
use Konceiver\Passwordless\Notifications\SendPassphrase;

final class RequirePassphrase
{
    public function handle($event): void
    {
        if (Auth::viaRemember()) {
            return;
        }

        $passphrase = EFF::useFiveDiceList()->generate(5);

        Session::put(AuthSession::PASSPHRASE, $passphrase);
        Session::put(AuthSession::PASSPHRASE_EXPIRATION, now()->addMinutes(15)->timestamp);

        $event->user->notify(new SendPassphrase($passphrase));
    }
}
