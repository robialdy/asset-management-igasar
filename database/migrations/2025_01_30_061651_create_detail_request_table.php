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
        Schema::create('detail_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_admin')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('division_name')->nullable();
            $table->enum('type', ['Perbaikan', 'Pengembalian']);
            $table->foreignId('id_asset')->constrained('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_request');
    }
};
