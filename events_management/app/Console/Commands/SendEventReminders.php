<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to all event attendees that event is starts soon.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // end user which would point to the actual user that attens the event 
            // nested, eager loading of relationships 
            // will not only load the user but also all the attendee models 
            // we will have the events / attendees and the actual users of those attendees 
        $events = Event::with("attendees.user")
            ->whereBetween("start_time", [now(), now()->addDay()])
            ->get();

        $eventCount = $events->count();

        $eventLabel = Str::plural("event", $eventCount);

        $this->info("Fount {$eventCount} {$eventLabel}");

        $events->each(
            fn ($event) => $event->attendees->each(
                fn($attendee) => $attendee->user->notify(
                    new EventReminderNotification(
                        $event
                    )
                )
            )
        );

        $this->info("Reminder notifications sent successfully");
    }
}
