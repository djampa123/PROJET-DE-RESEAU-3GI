<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('driving_schools', function (Blueprint $table) {
            if (Schema::hasColumn('driving_schools', 'license_type')) {
                $table->dropColumn('license_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('driving_schools', function (Blueprint $table) {
            $table->string('license_type')->nullable();
        });
    }
};
