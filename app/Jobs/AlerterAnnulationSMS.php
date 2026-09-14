<?php

namespace App\Jobs;

use App\Models\Seance;
use App\Services\SmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AlerterAnnulationSMS implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Seance $seance)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SmsService $sms): void
    {
        $seance = $this->seance->loadMissing(['film', 'lieu']);

        $message = sprintf(
            'CinéFaso — La séance %s à %s au %s est annulée.',
            $seance->film->titre,
            $seance->date_heure->format('H:i'),
            $seance->lieu->nom
        );

        $seance->rappels()
            ->where('notifie', false)
            ->get()
            ->each(function ($rappel) use ($sms, $message) {
                $sms->send($rappel->telephone, $message);
                $rappel->update(['notifie' => true]);
            });
    }
}
