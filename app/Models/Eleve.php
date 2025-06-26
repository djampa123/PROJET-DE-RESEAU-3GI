<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Eleve extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'telephone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
