<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('license_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driving_school_id')->constrained()->onDelete('cascade');
            $table->string('license_type'); // Exemple : A, B, C
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('license_offers');
    }
};
