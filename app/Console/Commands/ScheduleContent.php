<?php

namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;


class ScheduleContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:schedulecontent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to start scheduling content';

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
        // find content that needs to be published and dispatch jobs
        $contents = \App\ScheduleContent::where('status', 'Scheduled')
            ->where('schedule_on', '<', Carbon::now())
            ->get();

        foreach ($contents as $content) {
            \App\Jobs\ScheduleContent::dispatch($content);
        }

    }
}
