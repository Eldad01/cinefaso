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
        Schema::create('lieux', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 150);
            $table->enum('type', ['salle_permanente', 'lieu_temporaire']);
            $table->string('adresse', 250);
            $table->string('ville', 100)->default('Ouagadougou');
            $table->string('telephone', 20)->nullable();
            $table->text('description')->nullable();
            $table->string('horaires', 200)->nullable();
            $table->string('tarifs', 200)->nullable();
            $table->string('photo', 250)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->foreignId('festival_id')->nullable()->constrained('festivals')->nullOnDelete();
            $table->boolean('partenaire')->default(true);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lieux');
    }
};
