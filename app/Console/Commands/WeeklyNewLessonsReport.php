<?php

namespace App\Console\Commands;

use App\Lesson;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WeeklyNewLessonsReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lessons:new:lastweek';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report of the newly lessons added in the past week.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $timestamp = Carbon::now()->subDays(7)->timestamp;
        $lessons = Lesson::whereRaw('UNIX_TIMESTAMP(created_at) >= ' . $timestamp)->get();

        $report = '';
        foreach($lessons as $lesson)
        {
            $report .= $lesson->title . "\n";
        }

        if( ! $report )
        {
            $this->info("There are no newly added lessons!");
        }
        else
        {
            $this->info($report);
        }
    }
}
