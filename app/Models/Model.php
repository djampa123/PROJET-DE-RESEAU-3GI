<?php

// Modèle Eleve (app/Models/Eleve.php)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'telephone',
    ];
}

// Migration pour la table eleves (database/migrations/2025_06_22_create_eleves_table.php)
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevesTable extends Migration
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
        });
    }

    public function down()
    {
        Schema::dropIfExists('eleves');
    }
}