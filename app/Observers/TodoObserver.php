<?php

namespace App\Observers;

use App\Mail\TodoCompleted;
use App\Mail\TodoCreated;
use App\Mail\TodoRemoved;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Module\Todo\Enums\MailProvidersEnum;
use Module\Todo\Enums\NotificationsType;
use Module\Todo\Models\Todo;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     */
    public function created(Todo $todo): void
    {
        $this->notifySubscribers(NotificationsType::CREATED, User::find($todo->user_id));
    }

    /**
     * Handle the Todo "updated" event.
     */
    public function updated(Todo $todo): void
    {
        if($todo->wasChanged('completed_at') && !is_null($todo->completed_at)){
            $this->notifySubscribers(NotificationsType::CREATED, User::find($todo->user_id));
        }
    }

    /**
     * Handle the Todo "deleted" event.
     */
    public function deleted(Todo $todo): void
    {
        $this->notifySubscribers(NotificationsType::REMOVED, User::find($todo->user_id));
    }

    private function notifySubscribers(NotificationsType $type, User $ownerUser)
    {
        $ownerUser->subscribers()->chunk(50, function ($subscribers) use ($type){
            foreach ($subscribers as $subscriber) {
                $mailableClass = $this->getMailable($type);
                Mail::mailer('log')//MailProvidersEnum::providerSlug($subscriber->mail_provider_id))
                    ->to($subscriber->email)
                    ->queue(new $mailableClass());
            }
        });
    }

    private function getMailable(NotificationsType $type)
    {
        return match ($type){
            NotificationsType::CREATED => TodoCreated::class,
            NotificationsType::COMPLETED => TodoCompleted::class,
            NotificationsType::REMOVED => TodoRemoved::class,
            default => throw new \Exception('Unsupported Mail'),
        };
    }

}
