<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = [
        'nama_pemilik', 
        'alamat',
        'email', 
        'no_wa',
        'iduser',
    ];

    /**
     * Relasi belongsTo ke User (One-to-One)
     * Pemilik adalah bagian dari User, seperti Dokter dan Perawat
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /**
     * Relasi hasMany ke Pet (One-to-Many)
     */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}
