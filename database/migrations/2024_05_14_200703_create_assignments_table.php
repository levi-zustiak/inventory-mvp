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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instance_id')->constrained('item_instances');
            $table->foreignId('assigned_by')->constrained('users');
            $table->foreignId('assigned_to')->constrained('users');
            $table->foreignId('previous_id')->nullable()->constrained('assignments');
            $table->string('release_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
