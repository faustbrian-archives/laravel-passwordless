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

namespace Konceiver\Passwordless\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class SendPassphrase extends Notification
{
    use Queueable;

    public string $passphrase;

    public function __construct(string $passphrase)
    {
        $this->passphrase = $passphrase;
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage())
            ->subject('Your login passphrase for '.config('app.name'))
            ->line('Here is your login passphrase. It will expire after 15 minutes.')
            ->line($this->passphrase)
            ->line('Thank you for using our application!');
    }
}
