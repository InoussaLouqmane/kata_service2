<?php

namespace App\Jobs;

use App\Models\Exam;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExamAchievementProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $event_id;
    public function __construct($event_id)
    {
        $this->$event_id = $event_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
