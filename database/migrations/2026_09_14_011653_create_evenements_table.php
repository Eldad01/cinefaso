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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lieu_id')->nullable()->constrained('lieux')->nullOnDelete();
            $table->foreignId('festival_id')->nullable()->constrained('festivals')->nullOnDelete();
            $table->string('titre', 200);
            $table->text('description')->nullable();
            $table->enum('type', ['avant_premiere', 'debat', 'ceremonie', 'projection_speciale', 'autre']);
            $table->dateTime('date_heure');
            $table->string('affiche', 250)->nullable();
            $table->boolean('est_fespaco')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
