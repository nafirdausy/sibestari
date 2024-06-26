<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'fullname',
        'nama_lembaga',
        'alamat_lembaga',
        'telp_lembaga',
        'role',
        'gambar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function datasiswa()
    {
        return $this->hasMany(DataSiswa::class, 'id_users');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_users');
    }

    public function eval()
    {
        return $this->hasMany(Evaluasi::class, 'id_users');
    }
}
