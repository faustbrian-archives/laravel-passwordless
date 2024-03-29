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

namespace Konceiver\Passwordless\Enums;

final class AuthSession
{
    const PASSPHRASE = 'passphrase';

    const PASSPHRASE_EXPIRATION = 'passphrase_expiration';
}
