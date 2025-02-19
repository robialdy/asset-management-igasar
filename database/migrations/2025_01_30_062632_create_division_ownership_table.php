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
        Schema::create('division_ownership', function (Blueprint $table) {
            $table->id();
            $table->string('code_ownership')->unique();
            $table->foreignId('id_division')->constrained('division')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_asset')->constrained('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('attachment');
            $table->string('return_attachment');
            $table->dateTime('return_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_ownership');
    }
};
