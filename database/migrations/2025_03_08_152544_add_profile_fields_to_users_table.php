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
        Schema::table('users', function (Blueprint $table) {
            // نتحقق من وجود العمود قبل إضافته
            if (!Schema::hasColumn('users', 'website')) {
                $table->string('website')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable();
            }
            if (!Schema::hasColumn('users', 'twitter')) {
                $table->string('twitter', 50)->nullable();
            }
            if (!Schema::hasColumn('users', 'instagram')) {
                $table->string('instagram', 50)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['website', 'phone', 'twitter', 'instagram']);
        });
    }
};
