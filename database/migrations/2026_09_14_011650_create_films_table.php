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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 200);
            $table->string('titre_original', 200)->nullable();
            $table->integer('duree_min');
            $table->year('annee');
            $table->string('langue', 100);
            $table->string('genre', 150);
            $table->text('synopsis')->nullable();
            $table->string('affiche', 250)->nullable();
            $table->string('realisateur', 150);
            $table->string('pays', 100);
            $table->boolean('est_africain')->default(false);
            $table->boolean('est_burkinabe')->default(false);
            $table->string('prix_fespaco', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
