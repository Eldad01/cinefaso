<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lieu_id')->constrained('lieux')->cascadeOnDelete();
            $table->foreignId('film_id')->constrained('films')->cascadeOnDelete();
            $table->foreignId('festival_id')->nullable()->constrained('festivals')->nullOnDelete();
            $table->dateTime('date_heure');
            $table->integer('tarif_fcfa');
            $table->enum('version', ['VF', 'VO', 'VOSTFR', '3D', '3D-VF', '3D-VOSTFR'])->default('VF');
            $table->integer('age_minimum')->nullable();
            $table->enum('categorie', ['normale', 'competition', 'hors_competition', 'panorama'])->default('normale');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
