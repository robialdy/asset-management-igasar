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
        Schema::create('user_ownership', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_asset')->constrained('assets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('attachment')->nullable();
            $table->string('return_attachment')->nullable();
            $table->date('added_date');
            $table->dateTime('return_at')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ownership');
    }
};
