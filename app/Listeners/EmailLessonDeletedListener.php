<?php

namespace App\Listeners;

use App\Events\LessonWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailLessonDeletedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LessonWasDeleted  $event
     * @return void
     */
    public function handle(LessonWasDeleted $event)
    {
        var_dump("The lesson with title " . $event->lesson->title . " was deleted!");
        die();
    }
}
