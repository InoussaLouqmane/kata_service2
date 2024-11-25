<?php

namespace App\Jobs;

use App\Mail\ExamAttestationSent;
use App\Models\Event;
use App\Models\Exam;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExamAchievementProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $event_id;
    public function __construct(String $event_id)
    {
        $this->event_id = $event_id;

    }

    /**
     * Execute the job.
     */
    public function handle(): \Illuminate\Http\JsonResponse
    {
            Log::info('Achievement process : Id de l examen : '.$this->event_id);
        try {

            BulletinMailingProcess::dispatch($this->event_id);

            return response()->json([
                'success' => true,
            ],200);

    }catch (Exception $e){
            Log::error("j'ai obtenu une erreur monumentale ".$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

    }
}
