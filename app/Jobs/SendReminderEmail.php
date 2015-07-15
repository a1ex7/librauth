<?php

namespace App\Jobs;

use App\User;
use App\Book;
use App\Jobs\Job;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminderEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;
    protected $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Book $book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $message_text = "Hello, {$this->user->firstname}, you should return the book, since 30 days have passed from the time when you took the book '{$this->book->title}'";

        $mailer->raw(
            $message_text,
            function ($message) {
                $message->subject('Return your book');
                $message->from('reminder@example.com', 'Reminder');
                $message->to($this->user->email);
            }
        );
    }
}
