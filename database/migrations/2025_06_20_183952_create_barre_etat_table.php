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
        Schema::create('barre_etat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('ticket')->onDelete('cascade');
            $table->timestamp('date_nouveau');
            $table->timestamp('date_enCours')->nullable();
            $table->timestamp('date_traiter')->nullable();
            $table->timestamp('date_fermer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barre_etat');
    }
};
