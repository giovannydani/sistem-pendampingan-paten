<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $_user; 

    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->_user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // event(new Registered($this->_user));
        if ($this->_user instanceof MustVerifyEmail && ! $this->_user->hasVerifiedEmail()) {
            $this->_user->sendEmailVerificationNotification();
        }
    }
}