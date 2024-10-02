<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
     public function up()
     {
         Schema::create('notes', function (Blueprint $table) {
             $table->id();
             $table->string('title');             // Título de la nota
             $table->text('description');         // Descripción de la nota
             $table->foreignId('user_id')         // Relación con el usuario
                   ->constrained()
                   ->onDelete('cascade');
             $table->string('tags')->nullable();  // Etiquetas (categorías)
             $table->date('due_date')->nullable(); // Fecha de vencimiento (opcional)
             $table->string('image')->nullable(); // Imagen asociada (opcional)
             $table->timestamps();                // Incluye fecha de creación
         });
     }
     

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
    
};
