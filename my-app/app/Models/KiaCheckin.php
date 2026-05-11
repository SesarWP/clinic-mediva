<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KiaCheckin extends Model
{
    protected $fillable = ['patient_id', 'trimester', 'is_safe', 'answers', 'bidan_note'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function alerts()
    {
        return $this->hasMany(KiaAlert::class);
    }
}
