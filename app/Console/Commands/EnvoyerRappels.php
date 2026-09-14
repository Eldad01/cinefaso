<?php

namespace App\Console\Commands;

use App\Jobs\EnvoyerRappelSMS;
use App\Models\Seance;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('rappels:envoyer')]
#[Description("Envoie les rappels SMS pour les séances qui commencent dans les 2 prochaines heures.")]
class EnvoyerRappels extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $seances = Seance::query()
            ->where('active', true)
            ->whereBetween('date_heure', [now(), now()->addHours(2)])
            ->with('rappels')
            ->get();

        $count = 0;

        foreach ($seances as $seance) {
            foreach ($seance->rappels->where('notifie', false) as $rappel) {
                EnvoyerRappelSMS::dispatch($rappel);
                $count++;
            }
        }

        $this->info("{$count} rappel(s) mis en file d'attente.");

        return self::SUCCESS;
    }
}
