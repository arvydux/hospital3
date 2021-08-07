<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'doctor_id'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class,'patient_id');
    }
}
