<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KiaAlert extends Model
{
    protected $fillable = ['patient_id', 'kia_checkin_id', 'red_flag_triggered', 'is_resolved'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function kiaCheckin()
    {
        return $this->belongsTo(KiaCheckin::class);
    }
}
