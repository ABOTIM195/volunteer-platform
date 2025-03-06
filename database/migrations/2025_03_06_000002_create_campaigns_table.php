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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->string('type');
            $table->decimal('target_amount', 10, 2)->nullable();
            $table->decimal('current_amount', 10, 2)->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
