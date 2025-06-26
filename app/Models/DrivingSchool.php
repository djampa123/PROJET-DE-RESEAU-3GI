<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'email',
        'phone',
        'description',
        'rating',
        'image',
        'document_path',
        'is_approved',
        'is_paid',
    ];

    // Relation : une auto-école propose plusieurs types de permis
    public function licenseOffers()
    {
        return $this->hasMany(LicenseOffer::class);
    }
}
