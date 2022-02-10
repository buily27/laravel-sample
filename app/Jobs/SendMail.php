<?php

namespace App\Jobs;

use App\Mail\MailNotify as MailNotify;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    private $messages;
    private $listManagers;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($messages, $listManagers)
    {
        $this->messages = $messages;
        $this->listManagers = $listManagers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for ($i = 0; $i < count($this->listManagers); $i++) {
            Mail::to($this->listManagers[$i]->username)->send(new MailNotify($this->messages[$i]));
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        echo $exception;
    }
}
