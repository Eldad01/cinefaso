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
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 200);
            $table->string('edition', 100)->nullable();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->text('description')->nullable();
            $table->string('affiche', 250)->nullable();
            $table->string('site_web', 250)->nullable();
            $table->text('palmares')->nullable();
            $table->boolean('actif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};
