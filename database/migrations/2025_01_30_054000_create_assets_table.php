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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('code_asset')->unique();
            $table->string('name');
            $table->text('description');
            $table->string('picture');
            $table->string('type'); //string dlu
            $table->foreignId('id_category')->constrained('category')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('stock');
            $table->datetime('added_date');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->string('unit');
            $table->string('pic_payment')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
