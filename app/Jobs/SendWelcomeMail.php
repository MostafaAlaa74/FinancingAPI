<?php

namespace App\Jobs;

use App\Mail\WelcomMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail implements ShouldQueue
{
    use Queueable;

    public $user;
    public $tries = 3; // Number of retry attempts
    public $timeout = 60; // Timeout in seconds

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->user->email)->send(new WelcomMail($this->user));
            Log::info('Welcome email sent to ' . $this->user->email);
        } catch (\Exception $e) {
            $this->fail($e);
            Log::error('Error sending welcome email to ' . $this->user->email . ': ' . $e->getMessage());
        }
    }

    public function failed(\Exception $exception)
    {
        Log::error('Welcome email failed to send to ' . $this->user->email . ': ' . $exception->getMessage());
    }
}
