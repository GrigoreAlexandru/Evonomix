<?php

namespace App\Jobs;


use App\Mail\PublishNotifier;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;


class ScheduleContent implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $content;

    /**
     * Create a new job instance.
     *
     * @param ScheduleContent $content
     */
    public function __construct(\App\ScheduleContent $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //change status and send email
        $this->content->status = 'Published';
        $this->content->save();

        $user = $this->content->user;

        Mail::to($user)->send(new PublishNotifier($user));
    }

    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }
}
