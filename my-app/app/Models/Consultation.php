<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = ['patient_id', 'bidan_id', 'sender_role', 'message'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function bidan()
    {
        return $this->belongsTo(User::class, 'bidan_id');
    }
}
