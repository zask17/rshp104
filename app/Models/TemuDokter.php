<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;
    
    protected $table = 'temu_dokter'; 
    
    protected $primaryKey = 'idreservasi_dokter'; 
    
    public $timestamps = false; 

    protected $fillable = [
        'idpet', 
        'idrole_user', // FK ke role_user, bukan id user
        'tanggal_temu', 
        'waktu_temu',   
        'alasan',       
        'no_urut',
        'waktu_daftar',
        'status',
    ];

    // Relasi TemuDokter belongsTo Pet (Pasien)
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet'); 
    }
    
    // Relasi ke RoleUser, agar bisa mengakses Dokter (User)
    public function roleUser()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    // Relasi TemuDokter belongsTo User (Dokter) - menggunakan relasi RoleUser
    // Ini membantu di index view untuk menampilkan nama dokter
    public function dokter()
    {
        // Relasi ke RoleUser (Dokter Pemeriksa)
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
}