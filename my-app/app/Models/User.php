<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isBidan(): bool
    {
        return $this->role === 'bidan';
    }

    public function isPasien(): bool
    {
        return $this->role === 'pasien';
    }

    /**
     * Relasi ke data pasien (untuk user dengan role pasien)
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Pemeriksaan ANC yang dilakukan oleh bidan ini
     */
    public function ancExaminations()
    {
        return $this->hasMany(AncExamination::class, 'bidan_id');
    }

    /**
     * Screening anemia yang dilakukan oleh bidan ini
     */
    public function anemiaScreenings()
    {
        return $this->hasMany(AnemiaScreening::class, 'bidan_id');
    }
}
