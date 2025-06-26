<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'driving_school_id',
        'license_type',
        'price',
    ];

    public function drivingSchool()
    {
        return $this->belongsTo(DrivingSchool::class);
    }
}
