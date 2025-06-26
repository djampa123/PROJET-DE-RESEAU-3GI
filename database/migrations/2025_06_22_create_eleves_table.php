<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->date('date_naissance')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
            $table->string('password');
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleves');
    }
};