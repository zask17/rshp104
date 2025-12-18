<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'idpemilik',
        'idjenis_hewan',
        'idras_hewan',
        'tanggal_lahir',
        'jenis_kelamin',
        'warna_tanda',
    ];

    // ===============================================
    // MUTATOR (Mengubah data sebelum disimpan ke DB)
    // ===============================================

    /**
     * Set the jenis_kelamin attribute.
     * Mengkonversi 'Jantan'/'Betina' menjadi '1'/'2' sebelum disimpan.
     */
    public function setJenisKelaminAttribute($value)
    {
        if ($value === 'Jantan') {
            $this->attributes['jenis_kelamin'] = '1';
        } elseif ($value === 'Betina') {
            $this->attributes['jenis_kelamin'] = '2';
        } else {
            // Jika dikirim nilai lain (misal 1 atau 2), simpan saja
            $this->attributes['jenis_kelamin'] = $value;
        }
    }

    // ===============================================
    // ACCESSOR (Mengubah data saat diambil dari DB)
    // ===============================================

    /**
     * Get the jenis_kelamin attribute.
     * Mengkonversi '1'/'2' menjadi 'Jantan'/'Betina' saat ditampilkan.
     */
    public function getJenisKelaminAttribute($value)
    {
        if ($value === '1') {
            return 'Jantan';
        } elseif ($value === '2') {
            return 'Betina';
        }
        return $value; // Kembalikan nilai asli jika null atau tidak terdefinisi
    }

    // ===============================================
    // RELATIONS
    // ===============================================

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // ===============================================
    // TAMBAHKAN RELASI UNTUK TEMU DOKTER DAN REKAM MEDIS
    // ===============================================

    /**
     * Relasi ke TemuDokter (Janji Temu)
     * Satu Pet bisa memiliki banyak jadwal temu/riwayat kunjungan
     */
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet', 'idpet');
    }



}