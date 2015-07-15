<?php

namespace App\Jobs;

use App\Book;
use App\Jobs\Job;
use App\User;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAddNewBookEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $book;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $users = User::all();

        $message_text = "Hello, new book was add to our library: '{$this->book->title}' by {$this->book->author}";

        foreach ($users as $user) {
            $mailer->raw(
                $message_text,
                function ($message) use ($user)
                {
                    $message->subject('New book add to the library');
                    $message->from('no-reply@example.com', 'Admin');
                    $message->to($user->email);
                }
            );
        }

    }
}
