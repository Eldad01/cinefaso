<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sponsors = [
            ['nom' => 'Faso Télécom', 'ordre' => 1, 'site_web' => 'https://example.com/faso-telecom'],
            ['nom' => 'Banque Sahel Faso', 'ordre' => 2, 'site_web' => 'https://example.com/banque-sahel-faso'],
            ['nom' => 'Ouaga Brasseries', 'ordre' => 3, 'site_web' => null],
            ['nom' => 'AirFaso', 'ordre' => 4, 'site_web' => 'https://example.com/airfaso'],
            ['nom' => 'Savana Assurances', 'ordre' => 5, 'site_web' => null],
        ];

        foreach ($sponsors as $data) {
            Sponsor::updateOrCreate(
                ['nom' => $data['nom']],
                [...$data, 'actif' => true]
            );
        }
    }
}
