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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
    $table->string('titre');
    $table->text('description');
    $table->string('demandeur');
    $table->string('assignee')->nullable();
    $table->string('piecesJointes')->nullable();
    $table->enum('etat', ['nouveau', 'enCours', 'traiter','fermer'])->default('nouveau');
    $table->timestamp('date');
    $table->timestamps();
    $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
