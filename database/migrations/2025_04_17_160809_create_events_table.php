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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título do evento
            $table->text('description'); // Descrição detalhada
            $table->date('event_date'); // Data do evento
            $table->time('event_time'); // Hora do evento
            $table->string('location'); // Local do evento
            $table->string('banner_path'); // Caminho do banner (imagem obrigatória)
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
