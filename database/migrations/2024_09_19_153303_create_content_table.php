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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('content_type_id');
            $table->unsignedBigInteger('content_status_id');
            $table->string('icon');
            $table->string('imdb_id');
            $table->timestamps();

            $table->foreign('content_type_id')
                  ->references('id')
                  ->on('content_type')
                  ->onDelete('cascade');

            $table->foreign('content_status_id')
                  ->references('id')
                  ->on('content_status')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};