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
        Schema::create('message', function (Blueprint $table) {
           $table->id();
    $table->text('messageEnvoyer');
    $table->unsignedBigInteger('ticket_id') ;
    $table->foreign('ticket_id')->references('id')->on('ticket')->onDelete('cascade');
    $table->string('piecesJointes')->nullable();
    $table->string('emetteur') ;
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
        Schema::dropIfExists('message');
    }
};
