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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_division')->nullable()->constrained('division')->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('email');
            $table->string('no_hp');
            $table->enum('role',['Admin', 'Staff']);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
