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
        Schema::create('supplies_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supply_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('quantity');
            $table->foreignId('requested_by')->constrained('users');
            $table->timestamp('approved_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies_request');
    }
};
