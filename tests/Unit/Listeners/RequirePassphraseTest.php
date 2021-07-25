<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Konceiver\Passwordless\Listeners\RequirePassphrase;
use Konceiver\Passwordless\Notifications\SendPassphrase;

beforeEach(fn () => $this->subject = new RequirePassphrase());

it('should send a notification', function (): void {
    Notification::fake();

    $this->subject->handle((object) [
        'user' => $user = new User(),
    ]);

    Notification::assertSentTo($user, SendPassphrase::class);
});

it('should not send a notification if the user is already authenticated', function (): void {
    Notification::fake();

    Auth::shouldReceive('viaRemember')->once()->andReturn(true);

    $this->subject->handle((object) [
        'user' => $user = new User(),
    ]);

    Notification::assertNothingSent();
});

final class RequirePassphraseTest extends Model
{
    use Notifiable;
}
