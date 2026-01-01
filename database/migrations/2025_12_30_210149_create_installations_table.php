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
        Schema::create('installations', function (Blueprint $table) {
            $table->id();
            $table->string('task_status')->default('Available');
            $table->string('name');
            $table->string('area')->nullable();
            $table->string('package')->nullable();
            $table->foreignId('team_id')->nullable()->constrained();
            $table->string('status')->default('pending');
            $table->date('scheduled_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installations');
    }
};
