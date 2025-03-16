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
        Schema::create('detail_procurement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_procurement')->constrained('procurement')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->integer('amount');
            $table->string('unit');
            $table->boolean('is_approved')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_procurement');
    }
};
