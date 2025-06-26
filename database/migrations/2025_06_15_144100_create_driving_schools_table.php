<?php

// database/migrations/xxxx_xx_xx_create_driving_schools_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrivingSchoolsTable extends Migration
{
    public function up(): void
    {
        Schema::create('driving_schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->string('offer')->default('Code + conduite');
            $table->integer('price')->default(0);
            $table->float('rating', 2, 1)->default(0); // Ex: 4.5
            $table->string('image')->nullable();
            $table->string('document_path')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driving_schools');
    }
}
