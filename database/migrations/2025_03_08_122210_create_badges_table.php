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
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('icon'); // اسم الأيقونة أو مسار الصورة
            $table->string('color')->default('#3490dc');
            $table->integer('required_points')->default(0); // النقاط المطلوبة للحصول على هذه الشارة
            $table->string('achievement_type')->nullable(); // نوع الإنجاز المطلوب (عدد التطوعات، عدد التبرعات، إلخ)
            $table->integer('achievement_count')->nullable(); // عدد مرات تحقيق الإنجاز
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
