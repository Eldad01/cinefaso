<?php

namespace App\Jobs;

use App\Models\Rappel;
use App\Services\SmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class EnvoyerRappelSMS implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Rappel $rappel)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SmsService $sms): void
    {
        $seance = $this->rappel->seance->loadMissing(['film', 'lieu']);

        $message = sprintf(
            'CinéFaso — Rappel : %s à %s au %s. À ce soir !',
            $seance->film->titre,
            $seance->date_heure->format('H:i'),
            $seance->lieu->nom
        );

        $sms->send($this->rappel->telephone, $message);

        $this->rappel->update(['notifie' => true]);
    }
}
